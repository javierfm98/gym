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
}
