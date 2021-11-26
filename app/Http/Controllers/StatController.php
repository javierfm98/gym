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

        $totalClients = User::clients()->count();
        $paidClients = User::clients()->where('payment_status', 1)->count();
        $unpaidClients = User::clients()->where('payment_status', 0)->count();
        $pendingClients = User::clients()->where('payment_status', 2)->count();


        $paidClientsJSON = $this->dataClientsJSON($totalClients, $paidClients, 1);
        $unpaidClientsJSON = $this->dataClientsJSON($totalClients, $unpaidClients, 0);
        $pendingClientsJSON = $this->dataClientsJSON($totalClients, $pendingClients, 2);

        $calculationProfits = $this->getProfitGym();
        $profitsArray = array_values($calculationProfits);
        $dateProfitsArray = array_keys($calculationProfits);

        $dateProfitFormat = $this->formatMonthProfit($dateProfitsArray);

        return view('stats.index', compact(
            'rate', 
            'countClientsRates' , 
            'totalClients' , 
            'paidClients' ,
            'unpaidClients',
            'pendingClients', 
            'paidClientsJSON',
            'unpaidClientsJSON',
            'pendingClientsJSON',
            'profitsArray',
            'dateProfitFormat'));
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

    public function dataClientsJSON($totalClients, $dataClients, $color){

        $arrayColors = ['#dc3545', '#28a745', '#f0ad4e'];

        $percentageClients = ($dataClients * 100)/$totalClients;
        $remaining = 100 - $percentageClients;

        $data = [];

        $data1['y'] = $percentageClients;
        $data1['color'] = $arrayColors[$color];

        $data2['y'] = $remaining;
        $data2['color'] = '#ececec';
        $data2['noTooltip'] = true;

        $data[] = $data1;
        $data[] = $data2;

        return $data;

    }

    public function getProfitGym(){

        $now = Carbon::today()->subMonth()->endOfMonth()->toDateString();
        $lastYear = Carbon::today()->subMonth()->startOfMonth()->subYear()->toDateString();


        $monthlyCounts = Subscription::where('status', 1)->whereBetween('end_at', [$lastYear, $now])
        ->select(
                DB::raw("DATE_FORMAT(end_at, '%Y-%m') as date"),
                DB::raw('rate_id as rate'),
                DB::raw('COUNT(1) as count')
            )->groupBy(['date', 'rate'])->orderBy('date', 'asc')->get()->makeHidden('subs_end')->toArray();


        foreach($monthlyCounts as $index => $count){
            $count[$count['date']] = $this->calculateProfit($count['count'], $count['rate']);
            unset($count['rate']);
            unset($count['count']);
            $monthlyCounts[$index] = $count;
        }

        $sumProfits = [];

        foreach($monthlyCounts as $total){
            $key = $total['date'];
            $sumProfits[$key] = array_sum(array_column($monthlyCounts,$key));
        }

        return $sumProfits;
    }

    public function calculateProfit($count, $rate){

        $price = Rate::where('id', $rate)->pluck('price')->first();
        $profit = $count * $price;

        return $profit;
    }

    public function formatMonthProfit($date){
        $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $arrayDateFormat = [];

        foreach($date as $format){
            $splitDate = explode("-",$format);
            $indexMonth = $splitDate[1]-1;
            $monthName = $months[$indexMonth];
            $arrayDateFormat[] = $monthName.' '.$splitDate[0];
        }

        return $arrayDateFormat;
    }   
}


