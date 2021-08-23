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

        public function getGoalBodyFat()
    {
        $user = Auth::user();
        $countMouths = [];
        $goalBodyFatCount = [];
        $mouths = Body::where('user_id' , $user->id)->orderBy('date')->get();

        foreach($mouths as $mouth){
            array_push($countMouths , $mouth->date_format);
        }

        $countMouths = array_unique($countMouths);
        $countMouths = array_values($countMouths);


        $goals_body_fat_array = Goal::where('user_id' , $user->id)->where('name_goal_id' , 2)->get();

        if($goals_body_fat_array){
            $goals_body_fat_array = $goals_body_fat_array->first();
            for($i = 0 ; $i< count($countMouths) ; $i++){
                array_push($goalBodyFatCount , $goals_body_fat_array['value']);
            }
         }

         return $goalBodyFatCount;
    }

    public function getWeight()
    {
        $user = Auth::user();
        $countMouths = $this->getAxis();

        $measurementsWeight = Body::select('value' , 'date')->where('user_id' , $user->id)->where('stat_id' , 1)->orderBy('date')->get()->toArray();
        $arrayWeight = $this->createArrayData($countMouths, $measurementsWeight);

        foreach($arrayWeight as $key =>$weight){
            if($weight == -1){
                unset($arrayWeight[$key]);
            }
        }

        $arrayWeight = array_values($arrayWeight);

        return $arrayWeight;
    }


        public function getBodyFat()
    {
        $user = Auth::user();
        $countMouths = $this->getAxis();

        $measurementsBodyFat = Body::select('value' , 'date')->where('user_id' , $user->id)->where('stat_id' , 2)->orderBy('date')->get()->toArray();
        $arrayBodyFat = $this->createArrayData($countMouths, $measurementsBodyFat);

        foreach($arrayBodyFat as $key =>$body){
            if($body == -1){
                unset($arrayBodyFat[$key]);
            }
        }

        $arrayBodyFat = array_values($arrayBodyFat);


        return $arrayBodyFat;
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

        foreach($arrayValue as $key =>$item){
            if($item == -1 && $key != 0 && $key != (count($arrayValue)-1)){
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

    public function getDataChart()
    {
        $user = Auth::user();
        $goals_weight = Goal::where('user_id' , $user->id)->where('name_goal_id' , 1)->first();
        $goals_body_fat = Goal::where('user_id' , $user->id)->where('name_goal_id' , 2)->first();
        $measurements = Body::where('user_id' , $user->id)->orderBy('date' , 'DESC')->get();

        $mouths = Body::where('user_id' , $user->id)->orderBy('date')->get();
        $countMouths = [];
        $countMouthsFormat = [];
        $goalWeightCount = [];
        $goalBodyFatCount = [];

        $goals_weight_array = Goal::where('user_id' , $user->id)->where('name_goal_id' , 1)->get();
        $goals_body_fat_array = Goal::where('user_id' , $user->id)->where('name_goal_id' , 2)->get();

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

        $measurementsWeight = Body::select('value' , 'date')->where('user_id' , $user->id)->where('stat_id' , 1)->orderBy('date')->get()->toArray();
        $measurementsBodyFat = Body::select('value' , 'date')->where('user_id' , $user->id)->where('stat_id' , 2)->orderBy('date')->get()->toArray();

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

        return compact(     'countMouths' , 
                            'goalWeightCount' , 
                            'goalBodyFatCount',
                            'arrayWeight',
                            'pointStartWeight',
                            'arrayBodyFat',
                            'pointStartBodyFat'
                    );

    }

}
