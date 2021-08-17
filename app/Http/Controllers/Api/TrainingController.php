<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Training;
use App\Reservation;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->only('day');
        $trainings = Training::where('day' , $date)->get();

        return $trainings;
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $training_id = $request->training;

        $data  =  [ 'user_id' => $user->id , 
                    'training_id' => $training_id ];

        Reservation::create($data);
        $countClientRes = Reservation::where('training_id' , $training_id)->get()->count();
        $trainingUpdate = Training::findOrFail($training_id);
        $trainingUpdate->enroll = $countClientRes;
        $trainingUpdate->save();

        $success = true;
        return compact('success');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $training = Training::findOrFail($id);

        $del = Reservation::where("user_id" , $user_id)->where("training_id" , $id)->delete();

        $countClientRes = Reservation::where('training_id' , $id)->get()->count();
        $trainingUpdate = Training::findOrFail($id);
        $trainingUpdate->enroll = $countClientRes;
        $trainingUpdate->save();

        $training_date = Training::where('id' , $id)->first()->training_day_DB;
        $training = Training::where('day' , $training_date)->get();

        return $training;

    }

    public function show($id)
    {
        $users = Reservation::where('training_id' , $id)->with('user')->get();
        $training = Training::findOrFail($id);

        return compact('users' , 'training');

    }
}
