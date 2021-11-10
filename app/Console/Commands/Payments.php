<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Subscription;
use Carbon\Carbon;

class Payments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:start';

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
        $currentDay = Carbon::now()->format('Y-m-d');
        $date = $currentDay->subDays(1);
        $allSubs = Subscription::where('end_at', $date)->get();

        foreach($allSubs as $subs){
            $subs->status = 0;
            $subs->save();

        }
  
       $this->info('Comando ejecutado correctamente');
    }
}
