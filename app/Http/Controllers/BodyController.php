<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Body;
use App\Goal;
use Carbon\Carbon;

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
        $measurements = Body::where('user_id' , $user_id)->get();

        $mouths = Body::where('user_id' , $user_id)->orderBy('date')->get(['date'])->toArray();
        $countMouths = [];
        $goalWeightCount = [];
        $goalBodyFatCount = [];

        $goals_weight_array = $goals_weight->toArray();
        $goals_body_fat_array =  $goals_body_fat->toArray();


        foreach($mouths as $mouth){
            array_push($countMouths , $mouth['date']);  
        }


         $countMouths = array_unique($countMouths);
         $countMouths = array_values($countMouths);

         
        for($i = 0 ; $i< count($countMouths) ; $i++){
            array_push($goalWeightCount , $goals_weight_array['value']);
            array_push($goalBodyFatCount , $goals_body_fat_array['value']);
        }

        $measurementsWeight = Body::where('user_id' , $user_id)->where('stat_id' , 1)->orderBy('date')->get()->toArray();

        //$arrayWeight = $this->createArrayWeight($countMouths, $measurementsWeight);

        return view('bodies.index' , compact(   'goals_weight' , 
                                                'goals_body_fat' , 
                                                'measurements' , 
                                                'countMouths' , 
                                                'goalWeightCount' , 
                                                'goalBodyFatCount'
                                            ));
    }

    public function createArrayWeight($mouths, $weightsArray)
    {
        $array = array_fill(0 , count($mouths) , 0);

        dd($array);

        foreach($mouths as $mouth){
            foreach($weightsArray as $weight){
                if($weight['date'] == $mouth){
                    print_r($weight['value']);
                }else{
                    dd($mouth);
                }
            }
        }



        dd("Prueba");
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
        $date = Carbon::now();

        if( $request->weight != null)
        {
            $stat_weight = Body::where('date' , $date->format('Y-m-d'))->where('stat_id' , 1)->first();

            if($stat_weight != null){
                $data = ['value' => $request->weight];

                $stat_weight->fill($data);
                $stat_weight->save(); 
            }else{
                Body::create([
                    'user_id' => $user_id,
                    'stat_id' => 1,
                    'value' => $request->weight,
                    'date' => $date
                ]);
            }    
        }

        if( $request->body_fat != null)
        {
            $stat_body_fat = Body::where('date' , $date->format('Y-m-d'))->where('stat_id' , 2)->first();

            if($stat_body_fat != null){
                $data = ['value' => $request->body_fat];

                $stat_body_fat->fill($data);
                $stat_body_fat->save(); 
            }else{
                Body::create([
                    'user_id' => $user_id,
                    'stat_id' => 2,
                    'value' => $request->body_fat,
                    'date' => $date
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
