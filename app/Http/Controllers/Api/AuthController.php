<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email' , 'password');
        $token = JWTAuth::attempt($credentials);

        if($token){
            $user = User::where('email' , $credentials['email'])->with('photo')->get()->first();
            $success = true;

            return compact('success' , 'user' , 'token');
        }else{
            $success = false;
            $message = 'Invalid credentials';
            return compact('success' , 'message');
        }

    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);

        $success = true;
        return compact('success');
    }
}
