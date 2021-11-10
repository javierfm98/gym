<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Rate;
use App\Subscription;
use Carbon\Carbon;
use Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\WelcomeMailable;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->get('search');

       $clients = User::clients()->orderBy('created_at', 'desc')
                    ->name($name)
                    ->paginate(5);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rates = Rate::all();

        return view('clients.create' , compact('rates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'surname' => 'nullable|min:3',
            'phone' => 'nullable|min:9|max:9',
            'rate' => 'required'
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre.',
            'name.min' => 'El nombre debe tener 3 caracteres mínimo.',
            'email.required' => 'El email debe ser una dirección de email válida.',
            'email.unique' => 'El email ya está registrado.',
            'surname.min' => 'El apellido debe tener 3 caracteres mínimo.',
            'phone.min' => 'El teléfono debe contener 9 números',
            'phone.max' => 'El teléfono debe contener 9 números',
            'rate.required' => 'Es necesario asignar una tarifa'
        ];

        


        $this->validate($request, $rules, $messages);

        $split = explode('@', $request->input('email'));
        $username = $split[0];
        $rate = Rate::where('id' , $request->rate)->pluck('duration');
        $password = Str::random(8);
        $token = Str::random(100);

         $user = User::create(
            $request->only('name', 'email', 'surname', 'phone')
            + [
                'role_id' => 3,
                'password' => bcrypt($password),
                /*'password' => bcrypt(123456789),*/
                'username' => $username , 
                'photo_id' => 1 , 
                'registration_token' => $token
            ]
        );

        $now = Carbon::now();

        $end_at = $now->addMonths($rate[0]);

        $subscription = Subscription::create([
                        'user_id' => $user->id,
                        'rate_id' => $request->rate,
                        'status' => 1,
                        'end_at' => $end_at
        ]);

        $url = url(route('verified.confirm', [
            'token' => $token,
            'email' => $user->email,
        ], false));

       // $user->sendEmailVerificationNotification();
        $data = [
            'email' => $user->email, 
            'password' => $password,
            'url' => $url
        ];


        Mail::to($user->email)->send(new WelcomeMailable($data));

        $notification = 'Cliente añadido correctamente.';
        return redirect('/clients')->with(compact('notification'));

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
        $client = User::findOrFail($id);
        $subscription = Subscription::where('user_id' , $id)->first();
        $rates = Rate::where('id' , '!=' , $subscription->rate_id)->get();

        return view('clients.edit' , compact('client' , 'subscription' , 'rates'));
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
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'. $id,
            'surname' => 'nullable|min:3',
            'phone' => 'nullable|min:9|max:9'
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre.',
            'name.min' => 'El nombre debe tener 3 caracteres mínimo.',
            'email.required' => 'El email debe ser una dirección de email válida.',
            'email.unique' => 'El email ya está registrado.',
            'surname.min' => 'El apellido debe tener 3 caracteres mínimo.',
            'phone.min' => 'El teléfono debe contener 9 números',
            'phone.max' => 'El teléfono debe contener 9 números'
        ];

        $this->validate($request, $rules, $messages);

      /*  $split = explode('@', $request->input('email'));
        $username = $split[0];*/
       
        $user = User::findOrFail($id);
        $data = $request->only('name', 'email', 'surname', 'phone' , 'username');

        $user->fill($data);
        $user->save();

        $subscription = Subscription::where('user_id' , $id)->first();
        $rate = Rate::where('id' , $request->rate)->pluck('duration');

        $now = Carbon::now();
        $end_at = $now->addMonths($rate[0]);

        $data_subs = ['rate_id' => $request->rate , 'end_at' => $end_at];

        $subscription->fill($data_subs);
        $subscription->save();


        $notification = 'Cliente se ha actualizado correctamente.';
        return redirect('/clients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = User::findOrFail($id);
        $clientName = $client->name;
        $client->delete();

        $subscription = Subscription::where('user_id' , $id);
        $subscription->delete();

        $notification = "El cliente $clientName se ha eliminado correctamente.";
        return redirect('/clients')->with(compact('notification'));
    }

    
}
