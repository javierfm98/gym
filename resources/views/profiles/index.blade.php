@extends('layouts.menu') 

@section('title', 'Editar perfil') 
@section('content')


      <div class="profile-container">
        <div class="profile-image">
          <div class="profile-image-container">
            <div class="image-profile-container">
              <label for="file-input">
                <img src="/img/{{ auth()->user()->photo->route }}" alt="Foto perfil" class="image-profile real-image" id="profilePhoto">
                <img src="/img/change.png" alt="Change" class="image-profile change">
              </label>
              <form action="/profiles/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
              <input type="file" name="" class="input-file" id="file-input">
            </div>
            <div class="name-profile-container">
              <span> {{ auth()->user()->name }} </span>
              <span> {{ auth()->user()->surname }} </span>
            </div>
          </div>
        </div>
        <div class="profile-details">
          <h3 class="title">Editar perfil</h3>
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

            <div class="input-container">
               <div class="input-box field-outlined" style="margin-bottom: 20px;">
                  <input type="text" name="name" class="input" value="{{ auth()->user()->name }}" autocomplete="name" required>
                  <label for="" class="label">Nombre</label>
               </div>
               <div class="input-box field-outlined" style="margin-bottom: 20px;">
                  <input type="text" name="surname" class="input" value="{{ auth()->user()->surname }}" required>
                  <label for="" class="label">Apellido</label>
               </div>
               <div class="input-box-100 field-outlined">
                  <input type="text" name="email" class="input" value="{{ auth()->user()->email }}" autocomplete="email" required>
                  <label for="" class="label">Correo</label>
               </div>
               <div class="input-box-100 field-outlined">
                  <input type="text" name="username" class="input" value="{{ auth()->user()->username }}" required>
                  <label for="" class="label">Nombre de usuario</label>
               </div>
               <div class="input-box-100 field-outlined">
                  <input type="text" name="phone" class="input" value="{{ auth()->user()->phone }}" required>
                  <label for="" class="label">Teléfono</label>
               </div>
               <p style="margin-bottom: 12px; margin-left: 3px;">Cambiar contraseña</p>
               <div class="input-box-100 field-outlined">
                  <input type="password" name="current_password" class="input">
                  <label for="" class="label">Contraseña actual</label>
               </div>
               <div class="input-box field-outlined" style="margin-bottom: 20px;">
                  <input type="password" name="new_password" class="input">
                  <label for="" class="label">Nueva contraseña</label>
               </div>
               <div class="input-box field-outlined" style="margin-bottom: 20px;">
                  <input type="password" name="confirm_password" class="input">
                  <label for="" class="label">Confirmar contraseña</label>
               </div>                 
            </div>
            <div>
              <button type="submit" class="button button-primary">Guardar</button>
              <a href="{{ route('home') }}" class="button button-cancel ">Cancelar</a>
            </div>
          </form>
        </div>
      </div>
      <script src="{{ asset('js/profile.js') }}"></script>

      @endsection 
