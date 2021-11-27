@extends('layouts.menu')

@section('title', 'Ajustes entrenos')
@section('content')


		@if (session('notification'))
      		<div class="custom-alert alert-green alert-no-wrapper">
            	{{ session('notification') }}
      		</div> 
		@endif

		@if (session('error'))
      		<div class="custom-alert alert-red alert-no-wrapper">
            	{{ session('error') }}
      		</div> 
		@endif

		<div class="wrapper">


			<h3 class="title">Ajustes de los entrenos</h3>
			<form action="{{ route('settings.store') }}" method="POST">
				@csrf
				<div class="input-container">
					<div class="input-box field-outlined no-margin-bottom">
						<input type="time" class="input input-time" name="start"  value="{{ old('08:00' , $setting->start)}}">
						<i class="far fa-clock fa-fw time-icon"></i>
						<label for="" class="label">Inicio</label> 
					</div>
					<div class="input-box field-outlined no-margin-bottom">
						<input type="time" class="input input-time" name="end"  value="{{ old('22:00' , $setting->end)}}">
						<i class="far fa-clock fa-fw time-icon"></i>
						<label for="" class="label">Fin</label> 
					</div>
				</div>
				<div class="radio-container">
					<div class="radio-box">
						<input type="radio" name="duration" id="radio1" value="60" required {{ ($setting->duration) == 60 ? 'checked' : '' }}>
						<label for="radio1">1 hora</label>									
					</div>
					<div class="radio-box">
						<input type="radio" name="duration" id="radio2" value="75" required {{ ($setting->duration) == 75 ? 'checked' : '' }}>
						<label for="radio2">1 hora y cuarto</label>									
					</div>
					<div class="radio-box">
						<input type="radio"  name="duration" id="radio3" value="90" required {{ ($setting->duration) == 90 ? 'checked' : '' }}>
						<label for="radio3">1 hora y media</label>									
					</div>
					<div class="radio-box">
						<input type="radio" name="duration" id="radio4" value="105" required {{ ($setting->duration) == 105 ? 'checked' : '' }}>
						<label for="radio4">1 hora y 45 minutos</label>									
					</div>
					<div class="radio-box">
						<input type="radio" name="duration" id="radio5" value="120" required {{ ($setting->duration) == 120 ? 'checked' : '' }}>
						<label for="radio5">2 horas</label>									
					</div>
					<div class="radio-box">
						<input type="radio" name="duration" id="radio6" value="135" required {{ ($setting->duration) == 135 ? 'checked' : '' }}>
						<label for="radio6">2 horas y cuarto</label>									
					</div>
					<div class="radio-box">
						<input type="radio" name="duration" id="radio7" value="150" required {{ ($setting->duration) == 150 ? 'checked' : '' }}>
						<label for="radio7">2 horas y media</label>									
					</div>
					<div class="radio-box">
						<input type="radio" name="duration" id="radio8" value="165" required {{ ($setting->duration) == 165 ? 'checked' : '' }}>
						<label for="radio8">2 hora y 45 minutos</label>									
					</div>
					<div class="radio-box">
						<input type="radio" name="duration" id="radio9" value="180" required {{ ($setting->duration) == 180 ? 'checked' : '' }}>
						<label for="radio9">3 horas</label>									
					</div>
				</div>
				<div>
					<button type="submit" class="button button-primary">Guardar</button>
					<a href="{{ route('trainings.index') }}" class="button button-cancel ">Cancelar</a>
				</div>
			</form>
		</div>

		<div class="wrapper">
			<h3 class="title">Tarifas</h3>
			<form action="{{ route('settings.updateRate') }}" method="POST">
				@csrf
				<div class="input-container">
					@foreach($rates as $rate)
						<div class="input-box field-outlined">
							<input type="hidden" name="id_rate_{{ $rate->id }}" value="{{ $rate->id }}">
							<input type="text" class="input" name="price_{{ $rate->id }}" value="{{ $rate->price }}">
							<label for="" class="label">{{ $rate->name }} (Euros)</label>
						</div>
					@endforeach
				</div>
				<div>
					<button class="button button-primary">Guardar</button>
				</div>
			</form>
		</div>

@endsection