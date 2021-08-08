@extends('layouts.menu')
@section('title', 'Crear entreno')

@section('content')

  <div class="container wrapper mt-5 px-5">
    <h3 class="mb-4">Crear nuevo entreno</h3>
    @if (session('notification'))
      <div class="alert alert-danger mb-4" role="alert">
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

    <form action="{{ route('trainings.store') }}" method="POST">
    	@csrf
      <div class="row">
        <div class="col field-outlined mb-4">      
          <input type="date" name="day" class="input input-date2" style="padding-left: 16px;" value="{{ old('day') }}" id="datePicker">
          <i class="far fa-calendar-alt fa-fw date-icon"></i> 
          <label class="label">Fecha</label>

          @if(auth()->user()->hasRole(['admin']))
          <div class="mt-4 field-outlined select">      
            <select name="trainer" class="input" required>
              <option disabled selected>Seleccione un entrenador</option>
              @foreach($trainers as $trainer)
                <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
              @endforeach
            </select>
            <label for="" class="label label-select">Entrenador</label>
          </div>
          @endif 
          
          <div class="mt-4 field-outlined select">      
            <select name="schedule" id="schedule" class="input" required>
              <option disabled selected>Seleccione una fecha para poder ver los horarios</option>
            </select>
            <label for="" class="label label-select">Horario</label>
          </div> 
        </div>

        <div class=" col-12 field-outlined">
          <input type="text" name="capacity" class="input" value="{{ old('capacity') }}" required>
          <label for="" class="label">Capacidad</label>
        </div>
      </div>
      <div class="row mt-4">
         <div class="col field-outlined">
           <textarea name="description" class="input-textarea ckeditor" rows="10" cols="50" placeholder="Escriba el entreno"></textarea>
            <label for="" class="label label-select">Entreno</label>
         </div>
      </div>

      <div class="row mt-4">
        <div class="col">
          <button type="submit" class="boton boton-primary">Crear entreno</button>
          <a href="{{ route('trainings.index') }}" class="boton boton-cancelar">Cancelar</a>
        </div>
      </div>

    </form>
  </div>



  <script src="{{ asset('js/hoursTraining.js') }}"></script> 

@endsection
