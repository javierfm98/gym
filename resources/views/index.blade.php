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

			<div class="home-container">
				<div class="home-box-1">
					<div class="wrapper card-home">
						<div class="card-home-header">
							Mis entrenos
						</div>
						<div class="card-home-body">
							@foreach($trainings as $training)
								<div class="list-home list-training">
									<div>
										<h6 class="list-home-info">{{ $training->training->start->format('H:i') }} - {{ $training->training->end->format('H:i') }}</h6>
										<small class="list-home-sub">{{ $training->training->day->format('d/m/Y') }}</small>
									</div>
								</div>
							@endforeach
							@if($trainings->isEmpty())
								<div class="empty-data small-empty">
									<h3>No tienes clases reservadas</h3>
								</div>
							@else
								<button class="button button-primary text-bold button-home-list">Ver todos</button>
							@endif
						</div>
					</div>							
				</div>
				<div class="home-box-2">
					<div class="wrapper card-home">
						<div class="card-home-header">
							Pagos recientes
						</div>
						<div class="card-home-body">
							@foreach($payments as $payment)
								<div class="list-home">
									<div>
										<h6 class="list-home-info">{{ $payment->rate->price }}€</h6>
										@if($payment->status == 1)
											<span class="badge-custom badge-green">PAGADO</span>
										@else
											<span class="badge-custom badge-red">NO PAGADO</span>
										@endif
										<small class="list-home-sub">{{ $payment->end_at->format('d/m/Y') }}</small>
									</div>
								</div>							
							@endforeach
							@if($payments->isEmpty())
								<div class="empty-data small-empty">
									<h3>No hay pagos</h3>
								</div>
							@else
								<button class="button button-primary text-bold button-home-list">Ver todos</button>
							@endif
						</div>
					</div>
				</div>
			</div> 

@endsection