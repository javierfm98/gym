<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Reservation;
use App\Training;
use App\Subscription;
use Carbon\Carbon;
use App\Photo;

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

        if($user->payment_status == 0){
            $status = false;
            return compact('status');
        }else{
            foreach($trainings as $training){
                $isReserved = $this->isReserved($clientReservation , $trainings ,  $training->id);
                if($isReserved){
                    $success = true;
                     return compact('success' , 'training');
                }
            }

            return compact('success');          
        }


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
        $subscription = Subscription::where('user_id' , $user->id)->orderBy('end_at', 'desc')->get();

        return $subscription;
    }

    public function uploadImage(Request $request)
    {
        $user = Auth::user();
        $photo=$request->file('image');
        $splitImage = explode(".",$request->name);
        $namePhoto = $splitImage[0];
        $extensionImage = $splitImage[1];

        $uniqueNamePhoto = $namePhoto."_".time().'.'.$extensionImage;

        $photo->move('img' , $uniqueNamePhoto);

        $profilePhoto = Photo::create(['route' =>  $uniqueNamePhoto]);
        $photoId = $profilePhoto->id;


        $data = ['photo_id' => $photoId ];
        $user->fill($data);
        $user->save(); 

        $success = true;
        return $success;
    }

    public function password(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'current_password' => 'password|required_with:new_password',
            'new_password' => 'required|min:9',
            'confirm_password' => 'required|same:new_password',
        ];

        $messages = [
            'new_password.min' =>'La contraseña nueva debe tener al menos 9 caracteres.',
            'confirm_password.same' =>'La contraseña nueva no coincicen con la confirmación.',
            'current_password.password' => 'La contraseña actual no coincice.',
            'current_password.required_with' => 'Para cambiar la contraseña tiene que introducir la contraseña actual',
            'current_password.required' => 'Debe escribir una contraseña',
            'new_password.required' => 'Debe escribir una contraseña',
            'confirm_password.required' => 'Debe escribir una contraseña'    
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
          //  dd($validator->errors()->toJson());
            $success = false;
           // $errors = $validator->errors()->toJson();
          //  return compact('success' ,  'errors');
            return compact('success'); 
        }else{
            $newPassword = $request->get('new_password');
            $password = bcrypt($newPassword);

            $user->password = $password;
            $user->save();
         /*   $data['success'] = true;
            return $data; */
            $success = true;
           return compact('success'); 
        }
    }
}
