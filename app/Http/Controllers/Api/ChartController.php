<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Body;
use App\Goal;

class ChartController extends Controller
{
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

    public function store(Request $request)
    {
        $user = Auth::user();
        $date = $request->day;


        if($request->weight != null)
        {
            $stat_weight = Body::where('date' , $date)->where('stat_id' , 1)->first();

            if($stat_weight != null){
                $data = ['value' => $request->weight];

                $stat_weight->fill($data);
                $stat_weight->save(); 
            }else{
                Body::create([
                    'user_id' => $user->id,
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
                    'user_id' => $user->id,
                    'stat_id' => 2,
                    'value' => $request->body_fat,
                    'date' =>  $date
                ]);
            }
        }

        $success = true;
        return compact('success');
    }

    public function storeGoal(Request $request)
    {
        $user = Auth::user();
        $goal_weight = Goal::where('user_id' , $user->id)->where('name_goal_id' , 1)->first();
        $goal_body_fat = Goal::where('user_id' , $user->id)->where('name_goal_id' , 2)->first();

        if( $request->goal_weight != null){
            if($goal_weight == null){
                Goal::create([
                    'user_id' => $user->id,
                    'value' => $request->goal_weight,
                    'name_goal_id' => 1
                ]);
            }else{
                $data = ['value' => $request->goal_weight];

                $goal_weight->fill($data);
                $goal_weight->save(); 
            }
        }

        if( $request->goal_body_fat != null){
            if($goal_body_fat == null){
                Goal::create([
                    'user_id' => $user->id,
                    'value' => $request->goal_body_fat,
                    'name_goal_id' => 2
                ]);
            }else{
                $data = ['value' => $request->goal_body_fat];

                $goal_body_fat->fill($data);
                $goal_body_fat->save(); 
            }
        }

        $success = true;
        return compact('success');
    }

    public function list()
    {
        $user = Auth::user();
        $measurements = Body::where('user_id' , $user->id)->orderBy('date' , 'DESC')->get();

        return $measurements;
    }

    public function destroy($id)
    {
        $stat = Body::findOrFail($id);
        $stat->delete();

        $success = true;
        return compact('success');
    }

    public function getGoal()
    {
        $user = Auth::user();
        $goals_weight = Goal::select('value')->where('user_id' , $user->id)->where('name_goal_id' , 1)->first();
        $goals_body_fat = Goal::select('value')->where('user_id' , $user->id)->where('name_goal_id' , 2)->first();

        return compact( 'goals_weight', 
                        'goals_body_fat');
    }

}
