<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Training;

class TrainingController extends Controller
{
    public function show(Request $request)
    {
        $date = $request->only('day');
        $trainings = Training::where('day' , $date)->get();

        return compact('trainings');
    }
}
