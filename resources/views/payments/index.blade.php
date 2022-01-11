@extends('layouts.menu')

@section('title', 'Mis pagos')
@section('content')

<div class="no-wrapper">
				<h3>Mis pagos</h3>
				<div class="table-container">
					@if(!($payments->isEmpty()))
						<table class="custom-table">
							<thead>
							 <tr style="text-align:center;">
							    <th>Concepto</th>
							    <th>Fecha</th>
							    <th>Importe</th>
							    <th></th>
							 </tr>
							</thead>
							<tbody>
								@foreach ($payments as $payment)
									<tr style="text-align:center;">
										<td> Pago {{ $payment->rate->name }} </td>
										<td> {{ $payment->end_at->format('d/m/Y') }} </td>
										<td> {{ $payment->rate->price }} €</td>
										<td>
											<form action="{{ route('payments.invoice') }}" method="POST">
												@csrf
												<input type="hidden" name="date" value="{{ $payment->end_at->format('Y-m-d') }}">
												<button type="submit" class="button-circle"><i class="fas fa-file-download fa-fw"></i></button>
											</form>	
										</td>
									</tr>
									<tr class="spacer"></tr>
								@endforeach 
							</tbody>						 	
						</table>
					@else
						<div class="empty-data">
							<h3>No tienes ningún pago</h3>
						</div>
					@endif 
				</div>
				<div>
         		 	{{ $payments->links('vendor.pagination.custom') }} 
      			</div>
      		</div>


@endsection