<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Subscription;
use Carbon\Carbon;

class Payment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambia estado de pago de la suscription de un cliente';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDay = Carbon::now();
        $date = $currentDay->subDays(1)->format('Y-m-d');
        $allSubs = Subscription::where('end_at', $date)->get();

     //   

        foreach($allSubs as $subs){
            if($subs->status == 1){
                $subscription = Subscription::create([
                    'user_id' => $subs->user->id,
                    'rate_id' => $subs->rate->id,
                    'status' => 2,
                    'end_at' => $subs->end_at->addMonths($subs->rate->duration)
                ]);
            }else if($subs->status == 2){
                $subs->status = 0;
                $subs->save();
            }
        }
  
       $this->info('Pagos actualizados correctamente');
    }
}
