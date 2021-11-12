<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Log;

class ActivateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $email = $request->get('email');
        $user_token = User::where('email' , $email)->first()->registration_token;

        if($user_token == null){
            return redirect('/');
        }else{
           return $next($request);
        }                    
    }
}
