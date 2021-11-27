<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Rate;
use Carbon\Carbon;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::findOrFail(1);
        $rates = Rate::all();

        return view('settings.index' , compact('setting' , 'rates'));
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
        $start = new Carbon($request->start);
        $end = new Carbon($request->end);

        if($start->gt($end)){
           $error = "La hora de fin es más pronto que la de inicio";
        }else if($start->eq($end)){
            $error = "Las horas de inicio y fin son las misma";
        }else{

            Setting::truncate();

            $data  = $request->only('start', 'end' , 'duration');

            Setting::create($data);

            $notification = 'Ajustes del entreno cambiados correctamente.'; 
        }

        return redirect('/settings')->with(compact('notification' , 'error')); 
    }

    public function updateRate(Request $request)
    { 

        for($i=1; $i<=3; $i++){
            $id = $request->get('id_rate_'.$i);
            $price = $request->get('price_'.$i);
            if($price == null || $price < 0){
                $error = "Error el modificar las tarifas";
                return redirect('/settings')->with(compact('error'));
            }
            $rate = Rate::findOrFail($id);
            $rate->price = $price;
            $rate->save();
        }

        $notification = 'Tarifas actualizas correctamente.';

        return redirect('/settings')->with(compact('notification')); 


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
