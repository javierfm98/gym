<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class VerifiedController extends Controller
{
    public function confirm()
    {
        return view('verified.index');
    }

    public function activate(Request $request)
    {

        $rules = [
            'password' => 'min:9',
            'password_confirmation' => 'same:password',
        ];

        $messages = [
            'password.min' =>'La contraseña debe tener al menos 9 caracteres.',
            'password_confirmation.same' =>'Las contraseñas no coincicen.',
        ];

        $this->validate($request, $rules, $messages);


        $token = $request->get('token');
        $password = bcrypt($request->get('password'));

        $user = User::where('registration_token' , $token)->first();

        $data = ['password' => $password , 'registration_token' => NULL];

        $user->fill($data);
        $user->save();

        Auth::login($user);

        return redirect('/login'); 

    }
}
