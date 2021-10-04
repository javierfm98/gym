@extends('layouts.menu')
@section('title', 'Editar entreno')

@section('content')

<div class="container wrapper mt-5 px-5">
          <h3 class="mb-4">Editar entreno</h3>
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
    <form action="{{ route('trainings.update' , $training->id) }}" method="POST">
    	@csrf
      @method('PUT')
  <div class="row">

    <div class="col field-outlined">
      <input type="date" name="day" id="datePicker" class="input input-date2" style="padding-left: 16px;" value="{{ old('day' , $training->day->format('Y-m-d'))}}" required>
      <i class="far fa-calendar-alt fa-fw date-icon"></i> 
       <label for="" class="label">Fecha</label>
       <input type="hidden" name=""  value="{{ $training->start->format('H:i') }}-{{ $training->end->format('H:i') }}">

        @if(auth()->user()->hasRole(['admin']))
          <div class="mt-4 field-outlined select">      
            <select name="trainer" class="input">
              <option value="" selected="selected">{{ $training->user->name }}</option>
              <option disabled>-------------</option>'
              @foreach($trainers as $trainer)
                <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
              @endforeach
            </select>
            <label for="" class="label label-select">Entrenador</label>
          </div>
        @endif 

      <div class="mt-4 field-outlined select">      
          <select name="schedule" id="horario" class="input" required>
          </select>
          <label for="" class="label label-select">Horario</label>
      </div>
    </div>

      <div class=" col-12 mt-4 field-outlined">
        <input type="text" name="capacity" class="input" value="{{ old('capacity' , $training->capacity) }}" required>
        <label for="" class="label">Capacidad</label>
      </div>
  </div>
  <div class="row mt-4">
     <div class="col field-outlined">
       <textarea name="description" class="input-textarea ckeditor" rows="10" cols="50">{{ $training->description }}</textarea>
        <label for="" class="label label-select">Entreno</label>
     </div>
  </div>

  <div class="row mt-4">
      <div class="col">
        <button type="submit" class="boton boton-primary">Guardar</button>
        <a href="{{ route('trainings.index') }}" class="boton boton-cancelar">Cancelar</a>
      </div>
  </div>
</form>
  </div>

  <script src="{{ asset('js/hoursEdit.js') }}"></script>

@endsection