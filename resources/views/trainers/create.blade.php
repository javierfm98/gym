@extends('layouts.menu')
@section('title', 'Crear entrenador')

@section('content')

		<div class="wrapper">
			<h3 class="title">Dar de alta a un entrenador</h3>
			@if ($errors->any())
				<div class="custom-alert alert-red">
					<ul>
						@foreach ($errors->all() as $error)
			  				<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

           	<form action="{{ route('trainers.store') }}" method="POST">
           		@csrf
              	<div class="input-container">
                 	<div class="input-box field-outlined">
                    	<input type="text" name="name" class="input" value="{{ old('name')}}" autocomplete="name" autofocus required>
                    	<label for="" class="label">Nombre</label>
                 	</div>
                	<div class="input-box field-outlined">
                    	<input type="text" name="surname" class="input" value="{{ old('surname')}}" required>
                    	<label for="" class="label">Apellido</label>
                	</div>
                	<div class="input-box field-outlined">
                    	<input type="text" name="email" class="input" value="{{ old('email') }}" autocomplete="email" required>
                    	<label for="" class="label">Correo</label>
                	</div>
                	<div class="input-box field-outlined">
                    	<input type="text" name="phone" class="input"  value="{{ old('phone') }}" required>
                    	<label for="" class="label">Teléfono</label>
                 	</div>
              	</div>
				<div>
					<button type="submit" class="button button-primary">Dar de alta</button>
					<a href="{{ route('trainers.index') }}" class="button button-cancel ">Cancelar</a>
				</div>
           	</form>
		</div>
		
@endsection