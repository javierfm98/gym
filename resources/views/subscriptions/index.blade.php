@extends('layouts.menu') 

@section('title', 'Pagos')
@section('content')

			<div class="no-wrapper">
				<h3>Listado de pagos de clientes</h3>
				<div class="header">
					<div class="search-container">
						<form>
							<input type="text" name="search" class="search-bar" placeholder="Buscar..." value="{{ request()->get('search') }}" id="search" autocomplete="off">
							<i class="fas fa-search fa-fw icon-search"></i>
                        	<span class="clear" onclick="document.getElementById('search').value = ''"></span>							
						</form>
					</div>
					<div class="filter-container">
						<span class="text-bold">Filtrar por :</span>
						<div class="option-filter">
							<form>
								<input id="filter" type="hidden" name="filter"> 
								<button class="badge-filter {{ (request()->has('filter')) ? '' : 'badge-blue' }} {{ (request()->get('filter')) == '0' ? 'badge-blue' : '' }}" id="all" value="0">Todos</button>
								<button class="badge-filter {{ (request()->get('filter')) == '1' ? 'badge-blue' : '' }}" id="unpaid" value="1">Impago</button>
								<button class="badge-filter {{ (request()->get('filter')) == '2' ? 'badge-blue' : '' }}" id="paid" value="2">Pagado</button>
							</form>

						</div>
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
												<form action="{{ route('subscriptions.paid') }}" method="POST">
													@csrf
													<input type="hidden" name="id" value="{{ $subscription->id }}">
													<button class="button-circle"><i class="fas fa-check fa-fw "></i></button>	
												</form>
												<form action="{{ route('subscriptions.unpaid') }}" method="POST">
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
         			{{ $subscriptions->appends(request()->input())->links('vendor.pagination.custom') }}  
      			</div>
      		</div>

@endsection

@section('scripts')

				<script src="{{ asset('js/search.js') }}"></script>
				<script>
					var all = document.getElementById('all');
					var unpaid = document.getElementById('unpaid');
					var paid = document.getElementById('paid');

					$(window).unbind().click(function(e) {
						if(e.target == all){
							document.getElementById("filter").value = 0;
						}else if(e.target == unpaid){
							document.getElementById("filter").value = 1;
						}else{
							document.getElementById("filter").value = 2;
						}
					});
				</script>
@endsection