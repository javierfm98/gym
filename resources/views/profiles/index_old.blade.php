@extends('layouts.menu') 

@section('title', 'Editar perfil') 
@section('content')

<div class="row">
  <div class="col mt-4">
    <div class="wrapper-photo">
      <div>
        <label for="file-input">
          <div class="photo-profile"> <img src="/img/{{ auth()->user()->photo->route }}" alt="Avatar" class="image" id="img">
            <div class="middle">
              <div class="text"> <img src="/img/change.png" alt="Avatar" class="image"> </div>
            </div>
          </div>
        </label>
        <form action="/profiles/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
        <input type="file" name="photo" class="input-file" id="file-input"> </div>
      <div class="full_name">
        <div class="row prueba">
          <div class="col-12 name-col"> <span>{{ auth()->user()->name }}</span> </div>
          <div class="col surname-col"> <span>{{ auth()->user()->surname }}</span> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container wrapper mt-4 col-8">
    <h3 class="mb-4">Editar perfil</h3>
    @if (session('notification'))
      <div class="alert alert-success" role="alert">
        {{ session('notification') }}
      </div>
    @endif
    
    @if ($errors->any())
      <div class="alert alert-danger rounded-10 error" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
      @csrf
      @method('PUT')
      <div class="row" style="margin-bottom: 40px;">
        <div class=" col field-outlined">
        <input type="text" name="name" class="input" value="{{ auth()->user()->name }}" required autocomplete="name">
        <label for="" class="label">Nombre</label>
      </div>

            <div class=" col field-outlined">
        <input type="text" name="surname" class="input" value="{{ auth()->user()->surname }}" required>
        <label for="" class="label">Apellido</label>
      </div>

            <div class="col-12 mt-3 field-outlined">
        <input type="text" name="email" class="input" value="{{ auth()->user()->email }}" required autocomplete="email">
        <label for="" class="label">Correo</label>
      </div>

        <div class="col-12 mt-3 field-outlined">
        <input type="text" name="username" class="input" value="{{ auth()->user()->username }}" required>
        <label for="" class="label">Nombre de usuario</label>
      </div>

      <div class=" col-12 mt-3 field-outlined">
        <input type="text" name="phone" class="input" value="{{ auth()->user()->phone }}" required>
        <label for="" class="label">Teléfono</label>
      </div>
      <p class="mt-3 ml-2">Cambiar contraseña</p>
      <div class=" col-12 mb-2 field-outlined">
        <input type="password" name="current_password" class="input">
        <label for="" class="label">Contraseña actual</label>
      </div>
        <div class=" col mt-3 field-outlined">
        <input type="password" name="new_password" class="input">
        <label for="" class="label">Nueva contraseña</label>
      </div>

        <div class=" col mt-3 field-outlined">
        <input type="password" name="confirm_password" class="input">
        <label for="" class="label">Confirmar contraseña</label>
      </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          <button type="submit" class="boton boton-primary">Guardar</button> 
          <a href="{{ route('home') }}" class="boton boton-cancelar">Cancelar</a> 
        </div>
      </div>
    </form>
  </div>
  <script src="{{ asset('js/profile.js') }}"></script> 

  @endsection