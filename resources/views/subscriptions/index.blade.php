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
								<button class="badge-filter {{ (request()->has('filter')) ? '' : 'badge-blue' }} {{ (request()->get('filter')) == '0' ? 'badge-blue' : '' }}" id="all" onclick="setFilter(0)">Todos</button>
								<button class="badge-filter {{ (request()->get('filter')) == '1' ? 'badge-blue' : '' }}" onclick="setFilter(1)" id="unpaid">Impago</button>
								<button class="badge-filter {{ (request()->get('filter')) == '3' ? 'badge-blue' : '' }}" onclick="setFilter(3)" id="pending">Pendiente</button>
								<button class="badge-filter {{ (request()->get('filter')) == '2' ? 'badge-blue' : '' }}" onclick="setFilter(2)" id="paid">Pagado</button>
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
							    <th>Fecha</th>
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
										<td> {{ $subscription->end_at->format('d/m/Y') }} </td>
										<td>
											@if($subscription->status == 1)
												<span class="badge-custom badge-green">PAGADO</span>
											@elseif($subscription->status == 0)
												<span class="badge-custom badge-red">IMPAGO</span>
											@else
												<span class="badge-custom badge-yellow">PENDIENTE</span>
											@endif	
										</td>
										<td>
											<div class="action-container">

												<form action="{{ route('subscriptions.update' , $subscription->id) }}" method="POST">
													@csrf
													@method('PUT')
													<input  type="hidden" name="type_status" id="type_status_{{$subscription->id}}"> 
													<button type="submit" class="button-circle" onclick="setType(1,{{$subscription->id}})"><i class="fas fa-check fa-fw"></i></button>
													<button type="submit" class="button-circle" onclick="setType(0,{{$subscription->id}})"><i class="fas fa-times fa-fw"></i></button>
													<button type="submit" class="button-circle" onclick="setType(2,{{$subscription->id}})"><i class="fas fa-clock fa-fw"></i></button>		
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
					function setFilter(type){
						document.getElementById("filter").value = type;
					}
				</script>

				<script>
					function setType(type,id){
						var input_id = "type_status_" + id;
						document.getElementById(input_id).value = type;
					}
				</script>

@endsection