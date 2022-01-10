<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Body;
use App\Goal;
use Carbon\Carbon;
use App\Training;

class BodyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id =  auth()->user()->id;
        $goals_weight = Goal::where('user_id' , $user_id)->where('name_goal_id' , 1)->first();
        $goals_body_fat = Goal::where('user_id' , $user_id)->where('name_goal_id' , 2)->first();
        $measurements = Body::where('user_id' , $user_id)->orderBy('date' , 'DESC')->get();

        $months = Body::where('user_id' , $user_id)->orderBy('date')->get();
        $countMonths = [];
        $countMonthsFormat = [];
        $goalWeightCount = [];
        $goalBodyFatCount = [];


       

        $goals_weight_array = Goal::where('user_id' , $user_id)->where('name_goal_id' , 1)->get();
        $goals_body_fat_array = Goal::where('user_id' , $user_id)->where('name_goal_id' , 2)->get();

        foreach($months as $month){
            array_push($countMonths , $month->date_format);
        }

         $countMonths = array_unique($countMonths);
         $countMonths = array_values($countMonths);


         if(!$goals_weight_array->isEmpty()){
            $goals_weight_array = $goals_weight_array->first();
            for($i = 0 ; $i< count($countMonths) ; $i++){
                array_push($goalWeightCount , $goals_weight_array['value']);
            }
         }

         if(!$goals_body_fat_array->isEmpty()){
            $goals_body_fat_array = $goals_body_fat_array->first();
            for($i = 0 ; $i< count($countMonths) ; $i++){
                array_push($goalBodyFatCount , $goals_body_fat_array['value']);
            }
         }

        $measurementsWeight = Body::select('value' , 'date')
                                    ->where('user_id' , $user_id)
                                    ->where('stat_id' , 1)
                                    ->orderBy('date')
                                    ->get()
                                    ->toArray();

        $measurementsBodyFat = Body::select('value' , 'date')
                                    ->where('user_id' , $user_id)
                                    ->where('stat_id' , 2)
                                    ->orderBy('date')
                                    ->get()
                                    ->toArray();

     //  dd($measurementsWeight);

        $arrayWeight = $this->createArrayData($countMonths, $measurementsWeight);
        $pointStartWeight = $this->setPointStart($arrayWeight);

        $arrayBodyFat = $this->createArrayData($countMonths, $measurementsBodyFat);
        $pointStartBodyFat = $this->setPointStart($arrayBodyFat);

        foreach($arrayWeight as $key =>$weight){
            if($weight == -1){
                unset($arrayWeight[$key]);
            }
        }

        foreach($arrayBodyFat as $key =>$body){
            if($body == -1){
                unset($arrayBodyFat[$key]);
            }
        }

        $arrayWeight = array_values($arrayWeight);
        $arrayBodyFat = array_values($arrayBodyFat);

        $countMonths = $this->formatdate($countMonths);


        return view('bodies.index' , compact(   'goals_weight' , 
                                                'goals_body_fat' , 
                                                'measurements' , 
                                                'countMonths' , 
                                                'goalWeightCount' , 
                                                'goalBodyFatCount',
                                                'arrayWeight',
                                                'pointStartWeight',
                                                'arrayBodyFat',
                                                'pointStartBodyFat'
                                            ));
    }

    public function createArrayData($months, $dataArray)
    {
        $arrayValue = array_fill(0 , count($months) , -1);

        foreach($dataArray as $data){
            foreach($months as $key => $month){
                if($data['date_format'] == $month){
                    $arrayValue[$key] = $data['value'];
                    break;
                }
            }
        }

        $countNumber = $this->countNumber($arrayValue);

        foreach($arrayValue as $key =>$item){
            if($item == -1 && $key != 0 && $key != (count($arrayValue)-1) && count($arrayValue)-$countNumber != 1){
                $arrayValue[$key] = $arrayValue[$key-1];
            }
        }

       return $arrayValue;
    }

    public function setPointStart($arrayData){

        foreach($arrayData as $key => $data){
            if($data != -1){
                return $key;
            }
        }
        return 0;
    }

    public function countNumber($arrayData)
    {
        $count = 0;

        foreach($arrayData as $item){
            if($item == -1){
                $count++;
            }
        }

        return $count;

    }

    public function formatdate($dates){

        foreach($dates as $index => $date){
            $newDate = new Carbon($date);
            $dates[$index] = $newDate->format('d/m/Y');
        }

        return $dates;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $date = $request->day;

        if($request->weight != null){
            $this->storeMeasuring($user_id, $date, $request->weight, 1); //Weight
        }

        if( $request->body_fat != null){
             $this->storeMeasuring($user_id, $date, $request->body_fat, 2); //Body Fat
        }
        
        return redirect('bodies');
    }


    public function storeMeasuring($user_id, $date, $value, $stat_id)
    {
        $stat = Body::where('date', $date)->where('user_id', $user_id)->where('stat_id', $stat_id)->first();

        if($stat != null){
            $stat->value = $value;
            $stat->save();
        }else{
            $count = Body::where('stat_id', $stat_id)->where('user_id', $user_id)->get()->count();

            if($count >= 10){
                $oldestStat = Body::where('stat_id', $stat_id)->where('user_id', $user_id)->orderBy('date')->first();
                $oldestStat->date = $date;
                $oldestStat->value = $value;
                $oldestStat->save();
            }else{
                Body::create([
                    'user_id' => $user_id,
                    'stat_id' => $stat_id,
                    'value' => $value,
                    'date' => $date
                ]);
            }
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stat = Body::findOrFail($id);
        $stat->delete();

        return redirect('bodies');
    }
}
