<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goal;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $user_id =  auth()->user()->id;
        $goal_weight = Goal::where('user_id' , $user_id)->where('name_goal_id' , 1)->first();
        $goal_body_fat = Goal::where('user_id' , $user_id)->where('name_goal_id' , 2)->first();

        if( $request->goal_weight != null){
            if($goal_weight == null){
                Goal::create([
                    'user_id' => $user_id,
                    'value' => $request->goal_weight,
                    'name_goal_id' => 1
                ]);
            }else{
                $data = ['value' => $request->goal_weight];

                $goal_weight->fill($data);
                $goal_weight->save(); 
            }
        }

        if( $request->goal_body_fat != null){
            if($goal_body_fat == null){
                Goal::create([
                    'user_id' => $user_id,
                    'value' => $request->goal_body_fat,
                    'name_goal_id' => 2
                ]);
            }else{
                $data = ['value' => $request->goal_body_fat];

                $goal_body_fat->fill($data);
                $goal_body_fat->save(); 
            }
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
