@extends('layouts.menu') 

@section('title', 'Pagos')
@section('content')


				<h3>Listado de pagos de clientes</h3>
				<div class="header">
					<div class="search-container">
						 <input type="text" name="search" class="search-bar" placeholder="Buscar..." id="search">
						 <i class="fas fa-search fa-fw icon-search"></i>
					</div>

				</div>
				<div class="table-container">

					@if (session('notification'))
						<div class="custom-alert alert-green">
							{{ session('notification') }}
						</div>
					@endif

					@if(count($subscriptions) > 0)
						<table class="custom-table">
							<thead>
							 <tr style="text-align:center;">
							    <th>nombre</th>
							    <th>apellido</th>
							    <th>tipo</th>
							    <th>estatus</th>
							    <th></th>
							 </tr>
							</thead>
							<tbody>
								@foreach ($subscriptions as $subscription)
									<tr style="text-align:center;">
										<td> {{ $subscription->user->name }} </td>
										<td> {{ $subscription->user->surname }} </td>
										<td> {{ $subscription->rate->name}} </td>
										<td>
											@if($subscription->status == 1)
												<span class="badge-custom badge-green">PAGADO</span>
											@else
												<span class="badge-custom badge-red">IMPAGO</span>
											@endif	
										</td>
										<td>
											<div class="action-container">
												<form action="{{ route('subscriptions.unpaid') }}" method="POST">
													@csrf
													<input type="hidden" name="id" value="{{ $subscription->id }}">
													<button class="button-circle"><i class="fas fa-check fa-fw "></i></button>	
												</form>
												<form action="{{ route('subscriptions.paid') }}" method="POST">
													@csrf
													<input type="hidden" name="id" value="{{ $subscription->id }}">
													<button type="submit" class="button-circle"><i class="fas fa-times fa-fw"></i></button>	
												</form>
											</div>
										</td>
									</tr>
									<tr class="spacer"></tr>
								@endforeach
							</tbody>						 	
						</table>
					@else
						<div class="empty-data">
							<h3>No hay clientes</h3>
						</div>
					@endif
				</div>
				<div>
         			{{ $subscriptions->links('vendor.pagination.custom') }}  
      			</div>

@endsection

@section('scripts')

				<script src="{{ asset('js/search.js') }}"></script> 

@endsection