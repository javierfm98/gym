@extends('layouts.menu')
@section('title', 'Crear entreno')

@section('content')				

		<div class="wrapper">
			<h3 class="title">Crear nuevo entreno</h3>
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
				<div class="input-container">
					<div class="input-box-100 field-outlined">
						<input type="date" class="input input-date2" id="datePicker" name="day" value="{{ old('day') }}">
						<i class="far fa-calendar-alt fa-fw date-icon"></i> 
						<label for="" class="label">Fecha</label>
					</div>
					 @if(auth()->user()->hasRole(['admin']))
						<div class="select-box-m-20 select field-outlined">
							<select class="input" name="trainer">
								<option disabled selected>Seleccione un entrenador</option>
								@foreach($trainers as $trainer)
									<option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
								@endforeach
							</select>
							<label for="" class="label">Entrenador</label>
						</div>
					@endif 

					<div class="select-box-m-20 select field-outlined">
						<select class="input" name="schedule" id="schedule" required>
							<option disabled selected>Seleccione una fecha para poder ver los horarios</option>
						</select>
						<label for="" class="label">Horario</label>
					</div>
					<div class="input-box-100 field-outlined">
						<input type="text" class="input" name="capacity" value="{{ old('capacity') }}" required>
						<label for="" class="label">Capacidad</label>
					</div>
					<div class="input-box-100 field-outlined">
						<textarea name="description" class="input-textarea ckeditor" rows="10" cols="50" placeholder="Escriba el entreno"></textarea>
						<label for="" class="label label-select">Entreno</label>
					</div>
				</div>
				<div>
					<button type="submit" class="button button-primary">Crear entreno</button>
					<a href="{{ route('trainings.index') }}" class="button button-cancel">Cancelar</a>
				</div>
			</form>
		</div>

		<script src="{{ asset('js/hoursTraining.js') }}"></script> 

@endsection
