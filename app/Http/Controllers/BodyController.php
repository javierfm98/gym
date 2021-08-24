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

        $mouths = Body::where('user_id' , $user_id)->orderBy('date')->get();
        $countMouths = [];
        $countMouthsFormat = [];
        $goalWeightCount = [];
        $goalBodyFatCount = [];


       

        $goals_weight_array = Goal::where('user_id' , $user_id)->where('name_goal_id' , 1)->get();
        $goals_body_fat_array = Goal::where('user_id' , $user_id)->where('name_goal_id' , 2)->get();

        foreach($mouths as $mouth){
            array_push($countMouths , $mouth->date_format);
        }

         $countMouths = array_unique($countMouths);
         $countMouths = array_values($countMouths);


         if($goals_weight_array){
            $goals_weight_array = $goals_weight_array->first();
            for($i = 0 ; $i< count($countMouths) ; $i++){
                array_push($goalWeightCount , $goals_weight_array['value']);
            }
         }

         if($goals_body_fat_array){
            $goals_body_fat_array = $goals_body_fat_array->first();
            for($i = 0 ; $i< count($countMouths) ; $i++){
                array_push($goalBodyFatCount , $goals_body_fat_array['value']);
            }
         }

        $measurementsWeight = Body::select('value' , 'date')->where('user_id' , $user_id)->where('stat_id' , 1)->orderBy('date')->get()->toArray();
        $measurementsBodyFat = Body::select('value' , 'date')->where('user_id' , $user_id)->where('stat_id' , 2)->orderBy('date')->get()->toArray();

     //  dd($measurementsWeight);

        $arrayWeight = $this->createArrayData($countMouths, $measurementsWeight);
        $pointStartWeight = $this->setPointStart($arrayWeight);

        $arrayBodyFat = $this->createArrayData($countMouths, $measurementsBodyFat);
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

        return view('bodies.index' , compact(   'goals_weight' , 
                                                'goals_body_fat' , 
                                                'measurements' , 
                                                'countMouths' , 
                                                'goalWeightCount' , 
                                                'goalBodyFatCount',
                                                'arrayWeight',
                                                'pointStartWeight',
                                                'arrayBodyFat',
                                                'pointStartBodyFat'
                                            ));
    }

    public function createArrayData($mouths, $dataArray)
    {
        $arrayValue = array_fill(0 , count($mouths) , -1);

        foreach($dataArray as $data){
            foreach($mouths as $key => $mouth){
                if($data['date_format'] == $mouth){
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

        if( $request->weight != null)
        {
            $stat_weight = Body::where('date' , $date)->where('stat_id' , 1)->first();

            if($stat_weight != null){
                $data = ['value' => $request->weight];

                $stat_weight->fill($data);
                $stat_weight->save(); 
            }else{
                Body::create([
                    'user_id' => $user_id,
                    'stat_id' => 1,
                    'value' => $request->weight,
                    'date' =>  $date
                ]);
            }    
        }

        if( $request->body_fat != null)
        {
            $stat_body_fat = Body::where('date' , $date)->where('stat_id' , 2)->first();

            if($stat_body_fat != null){
                $data = ['value' => $request->body_fat];

                $stat_body_fat->fill($data);
                $stat_body_fat->save(); 
            }else{
                Body::create([
                    'user_id' => $user_id,
                    'stat_id' => 2,
                    'value' => $request->body_fat,
                    'date' =>  $date
                ]);
            }
        }

        return redirect('bodies');
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
