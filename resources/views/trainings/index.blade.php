@extends('layouts.menu') 

@section('title', 'Entrenos')
@section('content')

			@if(auth()->user()->hasRole(['admin']))
				<div class="settings-container">
					<a href="{{ route('trainings_settings.index') }}"><i class="fas fa-cog"></i></a>						
				</div>
			@endif

			<div class="header training-button-container">
				@if(auth()->user()->hasRole(['admin']))
					<h3>Todos los entrenos</h3>
				@endif

				@if(auth()->user()->hasRole(['trainer']))
					<h3>Tus entrenos</h3>
				@endif
						
				<a href="{{ route('trainings.create') }}" class="button button-add"> <i class="fas fa-plus fa-fw"></i>Añadir entreno</a>
			</div>
			<div class="table-container">
				@if (session('notification'))
					<div class="alert alert-success" role="alert">
						{{ session('notification') }}
					</div>
				@endif

				<table class="custom-table">
					<thead>
					 <tr style="text-align: center;">
					    <th>Dia</th>
					    <th>Horario</th>
					    <th>Capacidad</th>
						@if(auth()->user()->hasRole(['admin']))
							<th>Entrenador</th>
						@endif
					    <th></th>
					 </tr>
					</thead>
					<tbody>
						@foreach ($trainings as $training)
							<tr style="text-align: center;">
								<td> {{ Carbon\Carbon::parse($training->day)->format('d/m/Y') }} </td>
								<td> {{ Carbon\Carbon::parse($training->start)->format('H:i') }} - {{ Carbon\Carbon::parse($training->end)->format('H:i') }} </td>
								<td> {{ $training->capacity }} </td>
								@if(auth()->user()->hasRole(['admin']))
									<td> {{ $training->user->name }}</td>
								@endif
								<td>
								   <div class="action-container">
										<a href="{{ route('trainings.edit', $training->id) }}" class="button-circle"><i class="fas fa-user-edit fa-fw "></i></a>
										<form action="{{ route('trainings.destroy', $training->id) }}" method="POST">
											@csrf
											@method('DELETE')
											<button type="submit" class="button-circle"><i class="fas fa-trash fa-fw"></i></button>
										</form>
								   </div>
								</td>
							</tr>
							<tr class="spacer"></tr>
						@endforeach			
					</tbody>						 	
				</table>
			</div>

@endsection