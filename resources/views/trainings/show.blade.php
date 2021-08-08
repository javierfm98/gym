@extends('layouts.menu') 

@section('title', 'Detalles entreno')
@section('content')

    <div class=" container d-flex"> 
    </div>
    <div class="container wrapper-back mt-4">
      <form action="{{ route('reservations.backReservation') }}" method="POST" class="mb-2">
         @csrf
         <input type="hidden" name="date" value="{{ $training->day->format('Y-m-d') }}">
         <button type="submit" class="btn-circle border-0 btn-back-reservation"> <i class="fas fa-arrow-left fa-fw"></i> </button>
      </form> 
       <h3 class="mb-3">Detalles del entreno</h3>
       <h6 style="margin-left: 13px;">Atletas apuntados</h6>
       <div class="container">
          	<div class="row">
          		@foreach ($clients as $client)
            	<div class="col-2 detalles">
            		<form id="form-del"  action="{{ route('reservations.destroy', $client->training_id) }}" method="POST">
            			@csrf
                     @method('DELETE')
            			<input type="hidden" name="user_id" value="{{ $client->user_id}}">
            			<button type="submit" class="client-delete"><i class="fas fa-times icon-cross fa-fw"></i></button>
            		</form>
	                <div class="row">
	                   <div class="col-3 photo-col">
	                      <span><img src="/img/{{ $client->user->photo->route }}" alt="profileImg" class="detalles-photo"></span>
	                   </div>
	                   <div class="col-9 name-col">
	                      <span>{{ $client->user->name }} {{ $client->user->surname }}</span> 
	                   </div>
	                </div> 
            	</div>
            	@endforeach
       		</div>
       		@if(count($clients) < 1)
	            <div class="container mt-3 empty d-flex justify-content-center">
	               <h5 style="opacity: 0.5;" >No hay atletas apuntados</h5>
	            </div>
         	@endif
       	</div>
        <h6 style="margin-left: 13px;">Entrenador</h6>
        <div class="row">
            <div class="col-2 detalles">
                <div class="row">
                   <div class="col-3 photo-col">
                      <span><img src="/img/{{ $training->user->photo->route }}" alt="profileImg" class="detalles-photo"></span>
                   </div>
                   <div class="col-9 name-col">
                      <span>{{ $training->user->name }} {{ $training->user->surname }}</span> 
                   </div>
                </div> 
            </div>
        </div>
       <div class="container mt-4">
           <h3 class="mb-4 font-weight-bold">WOD</h3>
          <td>{!! nl2br($training->description) !!}</td>
       </div>
    </div>

@endsection
