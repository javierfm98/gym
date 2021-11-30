
			<div class="home-container">
				<div class="home-box-1">
					<div class="wrapper card-home">
						<div class="card-home-header">
							Mis entrenos
						</div>
						<div class="card-home-body">
							@foreach($trainingsTrainer as $trainingTrainer)
								<div class="list-home list-training" onclick="goTo({{ $trainingTrainer->id }})">
									<div>
										<h6 class="list-home-info">{{ $trainingTrainer->start->format('H:i') }} - {{ $trainingTrainer->end->format('H:i') }}</h6>
										<small class="list-home-sub">{{ $trainingTrainer->day->format('d/m/Y') }}</small>
									</div>
								</div>
							@endforeach
							@if($trainingsTrainer->isEmpty())
								<div class="empty-data small-empty">
									<h3>No tienes entrenos </h3>
								</div>
							@else
								<a href="{{ route('trainings.index') }}" class="button button-primary text-bold button-home-list">Ver todos</a>
							@endif
						</div>
					</div>							
				</div>
				<div class="home-box-2">
					<div class="wrapper card-home">
						<div class="card-home-header">
							Mis reservas
						</div>
						<div class="card-home-body">
							@foreach($trainings as $training)
								<div class="list-home list-training" onclick="goTo({{ $training->training->id }})">
									<div>
										<h6 class="list-home-info">{{ $training->training->start->format('H:i') }} - {{ $training->training->end->format('H:i') }}</h6>
										<small class="list-home-sub">{{ $training->training->day->format('d/m/Y') }}</small>
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
			</div>
		
		