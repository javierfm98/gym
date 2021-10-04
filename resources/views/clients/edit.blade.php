@extends('layouts.menu')
@section('title', 'Editar cliente')

@section('content')


		<div class="wrapper">
			<h3 class="title">Editar cliente</h3>
          	@if ($errors->any())
        		<div class="custom-alert alert-red">
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
				<div class="input-container">
					<div class="input-box field-outlined" style="margin-bottom: 20px;">
						<input type="text" name="name" class="input" value="{{ old('name' , $client->name)}}" autocomplete="name" required>
						<label for="" class="label">Nombre</label>
					</div>
					<div class="input-box field-outlined" style="margin-bottom: 20px;">
						<input type="text" name="surname" class="input" value="{{ old('surname' , $client->surname)}}" required>
						<label for="" class="label">Apellido</label>
					</div>
					<div class="input-box-100 field-outlined">
						<input type="text" name="email" class="input" value="{{ old('email' , $client->email) }}" autocomplete="email" required>
						<label for="" class="label">Correo</label>
					</div>
					<div class="input-box-100 field-outlined">
						<input type="text" name="username" class="input" value="{{ old('username' , $client->username) }}" required>
						<label for="" class="label">Nombre de usuario</label>
					</div>
					<div class="input-box-100 field-outlined">
						<input type="text" name="phone" class="input" value="{{ old('phone' , $client->phone) }}" required>
						<label for="" class="label">Teléfono</label>
					</div>
					<div class="select-box select field-outlined" style="margin-bottom: 20px;">
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
				<div>
					<button type="submit" class="button button-primary">Dar de alta</button>
					<a href="{{ route('clients.index') }}" class="button button-cancel ">Cancelar</a>
				</div>
			</form>
		</div>
		
@endsection

