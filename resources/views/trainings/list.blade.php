@extends('layouts.menu')

@section('title', 'Mis entrenos')
@section('content')

<div class="no-wrapper">
				<h3>Mis entrenos</h3>
				<div class="table-container">
					@if(!($trainings->isEmpty()))
						<table class="custom-table">
							<thead>
							 <tr style="text-align:center;">
							    <th>Fecha</th>
							    <th>Hora</th>
							    <th>Tipo</th>
							    <th>Ver entreno</th>
							 </tr>
							</thead>
							<tbody>
								@foreach ($trainings as $training)
									<tr style="text-align:center;">
										<td> {{ $training->day->format('d/m/Y') }} </td>
										<td> {{ $training->start->format('H:i') }} - {{ $training->end->format('H:i') }} </td>
										<td> Crossfit </td>
										<td>
											<div class="show-training-container">
												<a href="{{ route('trainings.show', $training->id) }}" class="button-circle"><i class="fas fa-eye fa-fw "></i></a>
											</div>
										</td>
									</tr>
									<tr class="spacer"></tr>
								@endforeach 
							</tbody>						 	
						</table>
					@else
						<div class="empty-data">
							<h3>No tienes ningún entreno</h3>
						</div>
					@endif 
				</div>
				<div>
         		 	{{ $trainings->links('vendor.pagination.custom') }} 
      			</div>
      		</div>


@endsection