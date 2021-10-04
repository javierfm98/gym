@extends('layouts.menu')
@section('title', 'Crear cliente')

@section('content')



<div class="container wrapper mt-4">
          <h3 class="mb-4">Dar de alta a un cliente</h3>
          @if ($errors->any())
        <div class="alert alert-danger rounded-10 error" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
  @endif
    <form action="{{ route('clients.store') }}" method="POST">
    	@csrf
    <div class="row" style="margin-bottom: 40px;">

      <div class=" col field-outlined">
        <input type="text" name="name" class="input" value="{{ old('name')}}" required autocomplete="name" autofocus="">
        <label for="" class="label">Nombre</label>
      </div>

      <div class=" col field-outlined">
        <input type="text" name="surname" class="input" value="{{ old('surname')}}" required>
        <label for="" class="label">Apellido</label>
      </div>
      </div>
      <div class="row">
        <div class="col field-outlined">
          <input type="text" name="email" class="input" value="{{ old('email') }}" required autocomplete="email">
          <label for="" class="label">Correo</label>
        </div>

        <div class="col field-outlined mb-3">
          <input type="text" name="phone" class="input"  value="{{ old('phone') }}" required>
          <label for="" class="label">Teléfono</label>
        </div>

        <div class="col-12 field-outlined mt-4 select">
            <select class="input" name="rate">
              <option disabled selected>Seleccione una tarifa</option>
              @foreach($rates as $rate)
                <option value="{{ $rate->id }}">{{ $rate->name }}</option>
              @endforeach
            </select>
             <label for="" class="label">Tarifa</label>
          
        </div>
      </div>


  
  <div class="row mt-4">
      <div class="col">
        <button type="submit" class="boton boton-primary">Dar de alta</button>
        <a href="{{ route('clients.index') }}" class="boton boton-cancelar">Cancelar</a>
      </div>
  </div>
</form>
  </div>

@endsection