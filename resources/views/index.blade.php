@extends('layouts.menu') 

@section('title', 'Inicio')

@section('content')

			<div class="welcome-container">
				<div class="welcome-box">
					<div class="welcome">
						<h1>Bienvenid@ {{ auth()->user()->name }}</h1>
						<p class="list-home-sub">{{ $phrases }}</p>									
					</div>
					<div class="logo-welcome">
						<img src="{{ asset('img/logo_blue.svg') }}" width="100" height="100" alt="Logo"> 
					</div>
				</div>
			</div>
			

			@if(auth()->user()->hasRole(['client']))
				@include('home.client')
			@elseif(auth()->user()->hasRole(['trainer']))
				@include('home.trainer')
			@elseif(auth()->user()->hasRole(['admin']))
				@include('home.admin')
			@endif

@endsection

@section('scripts')

<script>
	function goTo(trainingId){
		var base_url = document.getElementById('url').value;
		var url = base_url + '/trainings/' + trainingId;
		window.location = url;
	}
</script>


@endsection

