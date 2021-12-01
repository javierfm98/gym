
			<div class="home-container">
				<div class="home-box-1">
					<div class="wrapper card-home">
						<div class="card-home-header">
							Mis entrenos
						</div>
						<div class="card-home-body">
							@foreach($trainings as $training)
								<div class="list-home list-training" onclick="goTo({{ $training->id }})">
									<div>
										<h6 class="list-home-info">{{ $training->start->format('H:i') }} - {{ $training->end->format('H:i') }}</h6>
										<small class="list-home-sub">{{ $training->day->format('d/m/Y') }}</small>
									</div>
								</div>
							@endforeach
							@if($trainings->isEmpty())
								<div class="empty-data small-empty">
									<h3>No tienes clases reservadas</h3>
								</div>
							@else
								<a href="{{ route('trainings.list') }}" class="button button-primary text-bold button-home-list">Ver todos</a>
							@endif
						</div>
					</div>							
				</div>
				<div class="home-box-2">
					<div class="wrapper card-home">
						<div class="card-home-header">
							Pagos recientes
							@if(!($payments->isEmpty()))
							<span class="{{ ($nextPay < 0) ? 'text-red' : '' }} text-opacity-05">(Siguiente pago: {{ $nextPay }} dia/s)</span>
							@endif 
						</div>
						<div class="card-home-body">					
							@foreach($payments as $payment)
								<div class="list-home">
									<div>
										<h6 class="list-home-info">{{ $payment->rate->price }}€</h6>
										@if($payment->status == 1)
											<span class="badge-custom badge-green">PAGADO</span>
										@elseif($payment->status == 0)
											<span class="badge-custom badge-red">NO PAGADO</span>
										@else
											<span class="badge-custom badge-yellow">PENDIENTE</span>
										@endif
										<small class="list-home-sub">{{ $payment->end_at->format('d/m/Y') }}</small>
									</div>
								</div>							
							@endforeach		
							@if($payments->isEmpty())
								<div class="empty-data small-empty">
									<h3>No hay pagos</h3>
								</div>
							@else
								<a href="{{ route('payments.index') }}" class="button button-primary text-bold button-home-list">Ver todos</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		