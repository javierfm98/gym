<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Body;
use App\Goal;
use Carbon\Carbon;

class BodyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id =  auth()->user()->id;
        $goals_weight = Goal::where('user_id' , $user_id)->where('name_goal_id' , 1)->first();
        $goals_body_fat = Goal::where('user_id' , $user_id)->where('name_goal_id' , 2)->first();

        $measurements = Body::where('user_id' , $user_id)->get();

       // dd($measurements->toArray());

        return view('bodies.index' , compact('goals_weight' , 'goals_body_fat'));

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $date = Carbon::now();
        
        if( $request->weight != null)
        {
            Body::create([
                'user_id' => $user_id,
                'stat_id' => 1,
                'value' => $request->weight,
                'date' => $date
            ]);
        }

        if( $request->body_fat != null)
        {
            Body::create([
                'user_id' => $user_id,
                'stat_id' => 2,
                'value' => $request->body_fat,
                'date' => $date
            ]);
        }


        return redirect('bodies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
