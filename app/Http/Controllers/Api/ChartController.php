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

        $months = Body::where('user_id' , $user->id)->orderBy('date')->get();
        $countMonths = [];
        $countMonthsFormat = [];
        $goalWeightCount = [];
        $goalBodyFatCount = [];

        $goals_weight_array = Goal::where('user_id' , $user->id)->where('name_goal_id' , 1)->get();
        $goals_body_fat_array = Goal::where('user_id' , $user->id)->where('name_goal_id' , 2)->get();

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

        $measurementsWeight = Body::select('value' , 'date')->where('user_id' , $user->id)->where('stat_id' , 1)->orderBy('date')->get()->toArray();
        $measurementsBodyFat = Body::select('value' , 'date')->where('user_id' , $user->id)->where('stat_id' , 2)->orderBy('date')->get()->toArray();

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

        return compact(     'countMonths' , 
                            'goalWeightCount' , 
                            'goalBodyFatCount',
                            'arrayWeight',
                            'pointStartWeight',
                            'arrayBodyFat',
                            'pointStartBodyFat'
                    );

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

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $date = $request->day;


        if($request->weight != null){
            $this->storeMeasuring($user_id, $date, $request->weight, 1); //Weight
        }

        if( $request->body_fat != null){
             $this->storeMeasuring($user_id, $date, $request->body_fat, 2); //Body Fat
        }
        
        $success = true;
        return compact('success');
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
        $user = Auth::user();
        $stat = Body::findOrFail($id);
        $stat->delete();

        $measurements = Body::where('user_id' , $user->id)->orderBy('date' , 'DESC')->get();
        return $measurements;
    }

    public function getGoal()
    {
        $user = Auth::user();
        $goals_weight = Goal::where('user_id' , $user->id)->where('name_goal_id' , 1)->pluck('value');
        $goals_body_fat = Goal::where('user_id' , $user->id)->where('name_goal_id' , 2)->pluck('value');

        if(count($goals_weight) > 0){
            $number_goals_weight = $goals_weight[0];
        }else{
            $number_goals_weight = null;
        }

        if(count($goals_body_fat) > 0){
            $number_goals_body_fat = $goals_body_fat[0];
        }else{
            $number_goals_body_fat = null;
        }
        
        return compact( 'number_goals_weight', 
                        'number_goals_body_fat');
    }


}
