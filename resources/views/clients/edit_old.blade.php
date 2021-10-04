@extends('layouts.menu')
@section('title', 'Editar cliente')

@section('content')

<div class="container wrapper mt-5 px-5">
          <h3 class="mb-4">Editar cliente</h3>
          @if ($errors->any())
        <div class="alert alert-danger rounded-10 error" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
  @endif
    <form action="{{ route('clients.update' , $client->id) }}" method="POST">
    	@csrf
      @method('PUT')
  <div class="row">

          <div class=" col field-outlined">
        <input type="text" name="name" class="input" value="{{ old('name' , $client->name)}}" required autocomplete="name">
        <label for="" class="label">Nombre</label>
      </div>

            <div class=" col field-outlined">
        <input type="text" name="surname" class="input" value="{{ old('surname' , $client->surname)}}" required>
        <label for="" class="label">Apellido</label>
      </div>

            <div class="col-12 mt-3 field-outlined">
        <input type="text" name="email" class="input" value="{{ old('email' , $client->email) }}" required autocomplete="email">
        <label for="" class="label">Correo</label>
      </div>

        <div class="col-12 mt-3 field-outlined">
        <input type="text" name="username" class="input" value="{{ old('username' , $client->username) }}" required>
        <label for="" class="label">Nombre de usuario</label>
      </div>

      <div class=" col-12 mt-3 field-outlined">
        <input type="text" name="phone" class="input" value="{{ old('phone' , $client->phone) }}" required>
        <label for="" class="label">Teléfono</label>
      </div>

      <div class="col-12 field-outlined mt-4 select">
        <select class="input" name="rate">
          <option value="{{ $subscription->rate->id }}" selected="selected">{{ $subscription->rate->name }}</option>
          <option disabled>-------------</option>'
          @foreach($rates as $rate)
            <option value="{{ $rate->id }}">{{ $rate->name }}</option>
          @endforeach
        </select>
        <label for="" class="label">Tarifa</label>
      </div>

  </div>
  <div class="row mt-4">
      <div class="col">
        <button type="submit" class="boton boton-primary">Guardar</button>
        <a href="{{ route('clients.index') }}" class="boton boton-cancelar">Cancelar</a>
      </div>
  </div>
</form>
  </div>

@endsection