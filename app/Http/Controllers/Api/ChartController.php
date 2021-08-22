<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Body;

class ChartController extends Controller
{
    public function getAxis()
    {
        $user = Auth::user();
        $countMouths = [];
        $mouths = Body::where('user_id' , $user->id)->orderBy('date')->get();

        foreach($mouths as $mouth){
            array_push($countMouths , $mouth->date_format);
        }

        $countMouths = array_unique($countMouths);
        $countMouths = array_values($countMouths);

        return $countMouths;
    }
}
