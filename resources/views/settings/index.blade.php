@extends('layouts.menu')

@section('title', 'Ajustes entrenos')
@section('content')
	<div class="container wrapper mt-4">
		@if (session('notification'))
      		<div class="alert alert-success  mb-5 alert-reservation " role="alert" id="same">
            	{{ session('notification') }}
      		</div> 
		@endif

		@if (session('error'))
      		<div class="alert alert-danger  mb-5 alert-reservation " role="alert" id="same">
            	{{ session('error') }}
      		</div> 
		@endif

	   <h3 class="mb-4">Ajustes del entreno</h3>
	   <form action="{{ route('trainings_settings.store') }}" method="POST">
	   	@csrf
	      <div class="row" style="margin-bottom: 40px;">
	         <div class=" col field-outlined">
	            <input type="time" class="input input-time" name="start"  value="{{ old('08:00' , $setting->start)}}" >
	            <i class="far fa-clock fa-fw time-icon"></i> 
	            <label for="" class="label">Inicio</label>
	         </div>
	         <div class=" col field-outlined">
	             <input type="time" class="input input-time" name="end"  value="{{ old('22:00' , $setting->end)}}">
	             <i class="far fa-clock fa-fw time-icon"></i> 
	            <label for="" class="label">Fin</label>
	         </div>

	      </div>
	      <div class="row" style="margin-left: 7px;">
	        <div class="form-check mb-2">
	           <input class="form-check-input radio-button" type="radio" name="duration" id="radio1" value="60" required {{ ($setting->duration) == 60 ? 'checked' : '' }}/>
	           <label class="form-check-label" for="radio1">1 hora</label>
	         </div>
	         <div class="form-check mb-2">
	           <input class="form-check-input radio-button" type="radio" name="duration" id="radio2" value="75" required {{ ($setting->duration) == 75 ? 'checked' : '' }}>
	           <label class="form-check-label" for="radio2">1 hora y cuarto</label>
	         </div>
	          <div class="form-check mb-2">
	           <input class="form-check-input radio-button" type="radio" name="duration" id="radio3" value="90" required {{ ($setting->duration) == 90 ? 'checked' : '' }}>
	           <label class="form-check-label" for="radio3">1 hora y media</label>
	         </div>
	         <div class="form-check mb-2">
	           <input class="form-check-input radio-button" type="radio" name="duration" id="radio4" value="105" required {{ ($setting->duration) == 105 ? 'checked' : '' }}>
	           <label class="form-check-label" for="radio4">1 hora y menos cuarto</label>
	         </div>
	         <div class="form-check mb-2">
	           <input class="form-check-input radio-button" type="radio" name="duration" id="radio5" value="120" required {{ ($setting->duration) == 120 ? 'checked' : '' }}>
	           <label class="form-check-label" for="radio5">2 horas</label>
	         </div>
	         <div class="form-check mb-2">
	           <input class="form-check-input radio-button" type="radio" name="duration" id="radio6" value="135" required {{ ($setting->duration) == 135 ? 'checked' : '' }}>
	           <label class="form-check-label" for="radio6">2 horas y  cuarto</label>
	         </div>
	         <div class="form-check mb-2">
	           <input class="form-check-input radio-button" type="radio" name="duration" id="radio7" value="150" required {{ ($setting->duration) == 150 ? 'checked' : '' }}>
	           <label class="form-check-label" for="radio7">2 horas y media</label>
	         </div>
	         <div class="form-check mb-2">
	           <input class="form-check-input radio-button" type="radio" name="duration" id="radio8" value="165" required {{ ($setting->duration) == 165 ? 'checked' : '' }}>
	           <label class="form-check-label" for="radio8">2 horas y menos cuarto</label>
	         </div>
	         <div class="form-check mb-2">
	           <input class="form-check-input radio-button" type="radio" name="duration" id="radio9" value="180" required {{ ($setting->duration) == 180 ? 'checked' : '' }}>
	           <label class="form-check-label" for="radio9">3 horas</label>
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

@endsection
