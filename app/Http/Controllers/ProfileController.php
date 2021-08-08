<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Photo;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profiles.index');
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
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'. $id,
            'surname' => 'nullable|min:3',
            'phone' => 'nullable|min:9|max:9',
            'current_password' => 'nullable|password|required_with:new_password',
            'new_password' => 'nullable|min:9',
            'confirm_password' => 'nullable|same:new_password',
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre.',
            'name.min' => 'El nombre debe tener 3 caracteres mínimo.',
            'email.required' => 'El email debe ser una dirección de email válida.',
            'email.unique' => 'El email ya está registrado.',
            'surname.min' => 'El apellido debe tener 3 caracteres mínimo.',
            'phone.min' => 'El teléfono debe contener 9 números',
            'phone.max' => 'El teléfono debe contener 9 números',
            'new_password.min' =>'La contraseña nueva debe tener al menos 9 caracteres.',
            'confirm_password.same' =>'Las contraseñas nueva no coincicen con la confirmación.',
            'current_password.password' => 'La contraseña actual no coincice.',
            'current_password.required_with' => 'Para cambiar la contraseña tiene que introducir la contraseña actual'     
        ];

        $this->validate($request, $rules, $messages);
        
        $photo=$request->file('photo');
        $user = User::findOrFail($id);

        $newPassword = $request->new_password;

        if($newPassword){
            $password = bcrypt($newPassword);
        }else{
            $password = $user->password;
        }
        

        if($photo){
            $namePhoto = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $uniqueNamePhoto = $namePhoto."_".time().'.'.$photo->getClientOriginalExtension();
            $photo->move('img' , $uniqueNamePhoto);

            $profilePhoto = Photo::create(['route' => $uniqueNamePhoto]);

            $photoId = $profilePhoto->id;
        }else{
            $photoId = $user->photo_id;
        }



        
        $data = $request->only('name', 'email', 'surname', 'phone' , 'username') + ['photo_id' => $photoId , 'password' => $password];

        $user->fill($data);
        $user->save(); 

        $notification = 'Perfil actualizado correctamente.';
        return redirect('/profiles')->with(compact('notification'));
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
