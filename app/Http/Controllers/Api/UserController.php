<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Reservation;
use App\Training;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $user = User::where('id' , $user->id)->with('photo')->get()->first();
        return $user;
    }

    public function reservation()
    {
        $user = Auth::user();
        $reservation = Reservation::where('user_id' , $user->id)->get(['training_id']);
        $allReservation = Training::whereIn('id' , $reservation)->get();

        return $allReservation;
    }
}
