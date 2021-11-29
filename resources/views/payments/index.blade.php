@extends('layouts.menu')

@section('title', 'Mis pagos')
@section('content')

<div class="no-wrapper">
				<h3>Mis pagos</h3>
				<div class="header">
					<div class="filter-container">
						<span class="text-bold">Filtrar por :</span>
						<div class="option-filter">
							<form>
								<input id="filter" type="hidden" name="filter"> 
								<button class="badge-filter {{ (request()->has('filter')) ? '' : 'badge-blue' }} {{ (request()->get('filter')) == '0' ? 'badge-blue' : '' }}" id="all" onclick="setFilter(0)">Todos</button>
								<button class="badge-filter {{ (request()->get('filter')) == '1' ? 'badge-blue' : '' }}" onclick="setFilter(1)" id="unpaid">Impago</button>
								<button class="badge-filter {{ (request()->get('filter')) == '3' ? 'badge-blue' : '' }}" onclick="setFilter(3)" id="pending">Pendiente</button>
								<button class="badge-filter {{ (request()->get('filter')) == '2' ? 'badge-blue' : '' }}" onclick="setFilter(2)" id="paid">Pagado</button>
							</form>
						</div>
					</div>
				</div>
				<div class="table-container">
					@if(!($payments->isEmpty()))
						<table class="custom-table">
							<thead>
							 <tr style="text-align:center;">
							    <th>Concepto</th>
							    <th>Fecha</th>
							    <th>Importe</th>
							    <th>Estatus</th>
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
											@if($payment->status == 1)
												<span class="badge-custom badge-green">PAGADO</span>
											@elseif($payment->status == 0)
												<span class="badge-custom badge-red">IMPAGO</span>
											@else
												<span class="badge-custom badge-yellow">PENDIENTE</span>
											@endif	
										</td>
										<td>
											<button type="submit" class="button-circle"><i class="fas fa-file-download fa-fw"></i></button>
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