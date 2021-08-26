<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Reservation;
use App\Training;
use App\Subscription;
use Carbon\Carbon;

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
        $currentDate = Carbon::now();
        $reservation = Reservation::where('user_id' , $user->id)->get(['training_id']);
        $allReservation = Training::whereIn('id' , $reservation)->whereDate('day' , '>=' ,  $currentDate)->get();

        
        return $allReservation;
    }

    public function check(Request $request)
    {
        $user = Auth::user();
        $trainings = Training::where('day' , $request->date)->orderBy('start')->get();
        $clientReservation = Reservation::where('user_id' , $user->id)->get();
        $success = false;

        foreach($trainings as $training){
            $isReserved = $this->isReserved($clientReservation , $trainings ,  $training->id);
            if($isReserved){
                $success = true;
                 return compact('success' , 'training');
            }
        }

        return compact('success');   
    }


    public function isReserved($clientReservation , $trainings , $idTraining){

        foreach($trainings as $training){
            foreach($clientReservation as $reservation){
                if($training->id == $reservation->training_id && $training->id == $idTraining){
                    return true;
                }
            }
        }

        return false;
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->only('name', 'email', 'surname', 'phone' , 'username');

        $user->fill($data);
        $user->save();

        $user = User::where('id' , $user->id)->with('photo')->get()->first();
        return $user;
    }

    public function subs()
    {
        $user = Auth::user();
        $subscription = Subscription::where('user_id' , $user->id)->get();

        return $subscription;
    }

    public function uploadImage(Request $request)
    {
        $photo=$reques->photo;

      /*  $namePhoto = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
        $uniqueNamePhoto = $namePhoto."_".time().'.'.$photo->getClientOriginalExtension();
        $photo->move('img' , $request->name);

       // $profilePhoto = Photo::create(['route' => $uniqueNamePhoto]); */

        $success = true;
        return $photo;
    }
}
