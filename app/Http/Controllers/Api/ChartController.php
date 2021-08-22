<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Body;
use App\Goal;

class ChartController extends Controller
{
    public function getAxis()
    {
        $user = Auth::user();
        $countMouths = [];
        $mouths = Body::where('user_id' , $user->id)->orderBy('date')->get();

        foreach($mouths as $mouth){
            array_push($countMouths , $mouth->date_format);
        }

        $countMouths = array_unique($countMouths);
        $countMouths = array_values($countMouths);

        return $countMouths;
    }

    public function getGoalWeight()
    {
        $user = Auth::user();
        $countMouths = [];
        $goalWeightCount = [];
        $mouths = Body::where('user_id' , $user->id)->orderBy('date')->get();

        foreach($mouths as $mouth){
            array_push($countMouths , $mouth->date_format);
        }

        $countMouths = array_unique($countMouths);
        $countMouths = array_values($countMouths);


        $goals_weight_array = Goal::where('user_id' , $user->id)->where('name_goal_id' , 1)->get();

        if($goals_weight_array){
            $goals_weight_array = $goals_weight_array->first();
            for($i = 0 ; $i< count($countMouths) ; $i++){
                array_push($goalWeightCount , $goals_weight_array['value']);
            }
         }

         return $goalWeightCount;


    }
}
