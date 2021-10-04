	<h5>Añadir medicion</h5>
		<form action="{{ route('bodies.store') }}" method="POST" autocomplete="off">
			@csrf
			<div class="input-container">
				<div class="input-box-3 field-outlined">
					<input type="date" class="input input-date2" name="day" value="{{ old('day') }}" id="datePicker">
					 <i class="far fa-calendar-alt fa-fw date-icon"></i> 
					<label for="" class="label">Fecha</label>
				</div>
				<div class="input-box-3 field-outlined">
					<input type="text" class="input" name="weight">
					<label for="" class="label">Peso</label>
				</div>
				<div class="input-box-3 field-outlined" name="body_fat">
					<input type="text" class="input">
					<label for="" class="label">% Grasa corporal</label>
				</div>
			</div>
		<div>
			<button type="submit" class="button button-primary">Añadir</button>
		</div>
		</form>