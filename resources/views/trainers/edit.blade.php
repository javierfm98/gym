@extends('layouts.menu')
@section('title', 'Editar entrenador')

@section('content')


		<div class="wrapper">
			<h3 class="title">Editar entrenador</h3>
          	@if ($errors->any())
        		<div class="custom-alert alert-red">
          			<ul>
	            		@foreach ($errors->all() as $error)
	              			<li>{{ $error }}</li>
	            		@endforeach
          			</ul>
        		</div>
  			@endif

			<form action="{{ route('trainers.update' , $trainer->id) }}" method="POST">
    			@csrf
      			@method('PUT')
				<div class="input-container">
					<div class="input-box field-outlined" style="margin-bottom: 20px;">
						<input type="text" name="name" class="input" value="{{ old('name' , $trainer->name)}}" autocomplete="name" required>
						<label for="" class="label">Nombre</label>
					</div>
					<div class="input-box field-outlined" style="margin-bottom: 20px;">
						<input type="text" name="surname" class="input" value="{{ old('surname' , $trainer->surname)}}" required>
						<label for="" class="label">Apellido</label>
					</div>
					<div class="input-box-100 field-outlined">
						<input type="text" name="email" class="input" value="{{ old('email' , $trainer->email) }}" autocomplete="email" required>
						<label for="" class="label">Correo</label>
					</div>
					<div class="input-box-100 field-outlined">
						<input type="text" name="username" class="input" value="{{ old('username' , $trainer->username) }}" required>
						<label for="" class="label">Nombre de usuario</label>
					</div>
					<div class="input-box-100 field-outlined">
						<input type="text" name="phone" class="input" value="{{ old('phone' , $trainer->phone) }}" required>
						<label for="" class="label">Teléfono</label>
					</div>
				</div>
				<div>
					<button type="submit" class="button button-primary">Guardar</button>
					<a href="{{ route('trainers.index') }}" class="button button-cancel ">Cancelar</a>
				</div>
			</form>
		</div>
		
@endsection

