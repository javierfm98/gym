@extends('layouts.menu') 

@section('title', 'Entrenos')
@section('content')


<div class="container">
	@if(auth()->user()->hasRole(['admin']))
		<div class="col d-flex flex-row-reverse">
			<a href="{{ route('trainings_settings.index') }}" class="boton-settings" data-toggle="tooltip" data-placement="top" title="Ajustes del entreno"><i class="fas fa-cog fa-fw"></i></a>
		</div>
	@endif
	
		<div class="row">

			<div class="col">
				@if(auth()->user()->hasRole(['admin']))
					<h3 class="title-wrapper">Todos los entrenos</h3>
				@endif
				@if(auth()->user()->hasRole(['trainer']))
					<h3 class="title-wrapper mt-4">Tus entrenos</h3>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col d-flex flex-row-reverse">
				<a href="{{ route('trainings.create') }}" class="boton boton-green"> <i class="fas fa-plus fa-fw"></i>Añadir entreno</a>
			</div>			
		</div>
		
		<div class="table-responsive mt-4">

			@if (session('notification'))
      			<div class="alert alert-success" role="alert">
            			{{ session('notification') }}
      			</div>
      		@endif
			<table class="table custom-table">
				<thead>
					<tr style="text-align: center;">
						<th>Día</th>
						<th>Horario</th>
						<th  >Capacidad</th>
						 @if(auth()->user()->hasRole(['admin']))
						<th>Entrenador</th>
						@endif
					</tr>
				</thead>
				
				<tbody>
					@foreach ($trainings as $training)
				         <tr class="list" style="text-align: center;">
				           <td> {{ Carbon\Carbon::parse($training->day)->format('d/m/Y') }}</td>
				            <td> {{ Carbon\Carbon::parse($training->start)->format('H:i') }} - {{ Carbon\Carbon::parse($training->end)->format('H:i') }} </td>
				            <td> {{ $training->capacity }}</td>
				            @if(auth()->user()->hasRole(['admin']))
				            <td> {{ $training->user->name }}</td>
				            @endif
				            <td>
								<div class="d-flex flex-row-reverse">
									<button class="btn-circle btn border-0" data-toggle="tooltip" data-placement="top" title="Ver"> <i class="fas fa-eye fa-fw"></i> </button>
									<form action="{{ route('trainings.destroy', $training->id) }}" method="POST">
										@csrf
										@method('DELETE')

										<button type="submit" class="btn-circle btn border-0" data-toggle="tooltip" data-placement="top" title="Eliminar"> <i class="fas fa-trash fa-fw"></i> </button>
									</form>
									
									<a href="{{ route('trainings.edit', $training->id) }}" class="btn-circle btn border-0" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fas fa-user-edit fa-fw "></i> </a>
								</div>
							</td>
				         </tr>
				         <tr class="spacer"></tr>
			         @endforeach
		
				</tbody>
				
			</table>
			@if(count($trainings) < 1)
			<div class="container mt-5 empty d-flex justify-content-center">
				@if(auth()->user()->hasRole(['admin']))
					<h3 style="opacity: 0.5;" >No hay ningún entreno</h3>
				@endif
				@if(auth()->user()->hasRole(['trainer']))
					<h3 style="opacity: 0.5;" >No tienes ningún entreno</h3>
				@endif
			</div>
			
			@endif
		</div>
		{{ $trainings->links('vendor.pagination.custom') }}
	</div> 

@endsection

