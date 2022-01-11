<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use PDF;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $payments = Subscription::where('user_id', auth()->user()->id)->where('status' , 1)->orderBy('end_at', 'desc')->paginate(5);

        return view('payments.index', compact('payments'));
    }

    public function createPDF(Request $request)
    {
        $date = $request->date;
        $user_id = auth()->user()->id;

        $payment = Subscription::where('user_id' , $user_id)->where('end_at' , $date)->first();
        $pdf = PDF::loadView('payments.invoice' , ['payment' => $payment]);
       // return view('payments.invoice' , compact('payment'));
        return $pdf->download('factura_'.$date.'.pdf');
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
        //
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
