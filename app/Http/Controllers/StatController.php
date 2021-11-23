<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rate;
use App\User;
use App\Subscription;
use Carbon\Carbon;
use DB;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rate = Rate::all()->pluck('name')->toArray();

        $arrayRatesClients = Subscription::select(
            DB::raw('COUNT(1) as count')
        )->groupBy('rate_id')->pluck('count')->toArray();


        $countClientsRates = array_fill(0, count($rate), 0);

        foreach ($arrayRatesClients as $index => $arrayRatesClient) {
            $countClientsRates[$index] = $arrayRatesClient;
        }

     /*   $months = Subscription::get()->groupBy([function($d){
            return Carbon::parse($d->end_at)->format('m-Y');
        },'rate_id']);

        $monthlyCounts = Subscription::select(
            DB::raw('MONTH(end_at) as month'), 
            DB::raw('COUNT(1) as count')
        )->groupBy('month')->get()->toArray();*/

        $chartStatus = $this->getStatusGym();

        return view('stats.index', compact('rate', 'countClientsRates' , 'chartStatus'));
    }

    public function getStatusGym(){

        $countClients = User::clients()->count();
        $statusCounts = User::clients()->select(DB::raw('COUNT(1) as count'))->groupBy('payment_status')->pluck('count')->toArray();

        $countStatusClients = array_fill(0, 3, 0);

        foreach($statusCounts as $index => $statusCount){
            $countStatusClients[$index] = $statusCount;
        }

        $percentageStatusClients = [];

        for($i = 0; $i < 3; $i++){
            $percentageStatusClients[$i] = ($countStatusClients[$i] * 100)/$countClients;
        }

        $series = [];
        $series1['name'] = 'Clientes';

        $data = [];

        $data1['name'] = 'Pagados';
        $data1['y'] = $percentageStatusClients[0];
        $data1['clients'] = $countStatusClients[0];

        $data2['name'] = 'Impagos';
        $data2['y'] = $percentageStatusClients[1];
        $data2['clients'] = $countStatusClients[1];

        $data3['name'] = 'Pendiente';
        $data3['y'] = $percentageStatusClients[2];
        $data3['clients'] = $countStatusClients[2];

        $data[] = $data1;
        $data[] = $data2;
        $data[] = $data3;

        $series1['data'] = $data;

        $series[] = $series1;

        return $series;
    }

    
}

