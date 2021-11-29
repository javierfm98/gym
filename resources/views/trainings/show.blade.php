@extends('layouts.menu') 

@section('title', 'Detalles entreno')
@section('content')

	
		<div class="wrapper" style="padding-top:20px">
			<form action="{{ route('reservations.backReservation') }}" method="POST">
				@csrf
				<input type="hidden" name="date" value="{{ $training->day->format('Y-m-d') }}">
				<button type="submit" class="button-back"><i class="fas fa-arrow-left fa-fw"></i></button>	
			</form>
			<h3 style="margin-bottom: 12px;">Detalles del entreno</h3>
			<h6 class="indentation-training">Atletas apuntados</h6>
			<div class="details-clients">
				@foreach ($clients as $client)
					<div class="card-client">
						<form id="form-del" action="{{ route('reservations.destroy', $client->training_id) }}" method="POST">
            				@csrf
                     		@method('DELETE')
						   	<input type="hidden" name="user_id" value="{{ $client->user_id}}">
						   	@if(auth()->user()->hasRole(['admin']))
								<button type="submit" class="button-delete-client"><i class="fas fa-times fa-fw icon-cross"></i></button>
							@endif 
						</form>
						<img src="/img/{{ $client->user->photo->route }}" alt="profileImg" class="details-photo"></span>
						<span> {{ $client->user->name }} {{ $client->user->surname }} </span>
					</div>
				@endforeach
			</div>   
                    
            @if(count($clients) < 1)
                <div class="container mt-3 empty d-flex justify-content-center">
                    <h5 style="opacity: 0.5;" >No hay atletas apuntados</h5>
                </div>
            @endif

			<h6 class="indentation-training">Entrenador</h6>
			<div class="details-clients">
				<div class="card-client" style="cursor: default;">
					<img src="/img/{{ $training->user->photo->route }}" alt="profileImg" class="details-photo"></span>
					<span> {{ $training->user->name }} {{ $training->user->surname }} </span>
				</div>
			</div>
			<h3 class="title-trainging indentation-training">ENTRENO</h3>
			<div class="indentation-training">
				<td>{!! nl2br($training->description) !!}</td>
			</div>							
		</div>

@endsection
