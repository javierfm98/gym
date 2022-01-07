<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\WelcomeMailable;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->get('search');

       $trainers = User::trainers()->orderBy('created_at', 'desc')
                    ->name($name)
                    ->paginate(5);
        return view('trainers.index', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainers.create');
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
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre.',
            'name.min' => 'El nombre debe tener 3 caracteres mínimo.',
            'email.required' => 'El email debe ser una dirección de email válida.',
            'email.unique' => 'El email ya está registrado.',
            'surname.min' => 'El apellido debe tener 3 caracteres mínimo.',
            'phone.min' => 'El teléfono debe contener 9 números',
            'phone.max' => 'El teléfono debe contener 9 números',
        ];

        $this->validate($request, $rules, $messages);

        $split = explode('@', $request->input('email'));
        $username = $split[0];
        $password = Str::random(8);
        $token = Str::random(100);

        $user = User::create(
            $request->only('name', 'email', 'surname', 'phone')
            + [
                'role_id' => 2,
                'password' => bcrypt($password),
                /*'password' => bcrypt(123456789),*/
                'username' => $username , 
                'photo_id' => 1 , 
                'registration_token' => $token,
                'payment_status' => 1
            ]
        );

        $url = url(route('verified.confirm', [
            'token' => $token,
            'email' => $user->email,
        ], false));

        $data = [
            'email' => $user->email, 
            'password' => $password,
            'url' => $url
        ];
        
        Mail::to($user->email)->send(new WelcomeMailable($data));

        $notification = 'Entrenador añadido correctamente.';
        return redirect('/trainers')->with(compact('notification'));
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
        $trainer = User::findOrFail($id);
        return view('trainers.edit' , compact('trainer'));
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

        $user = User::findOrFail($id);
        $data = $request->only('name', 'email', 'surname', 'phone' , 'username');

        $user->fill($data);
        $user->save();        

        $notification = 'Entrenador actualizado correctamente.';
        return redirect('/trainers')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainer = User::findOrFail($id);
        $trainerName = $trainer->name;
        $trainer->delete();

        $notification = "El entrenador $trainerName se ha eliminado correctamente.";
        return redirect('/trainers')->with(compact('notification'));
    }
}
