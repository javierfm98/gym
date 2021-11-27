		<h5>Añadir objetivos</h5>
		<form>
			<div class="input-container">
				<div class="input-box field-outlined">
					@if($goals_weight)
						<input type="text" class="input" name="goal_weight" value="{{ $goals_weight->value }}">
					@else
						<input type="text" class="input" name="goal_weight">
					@endif
					<label for="" class="label">Peso (Kg)</label>
				</div>
				<div class="input-box field-outlined">
					@if($goals_body_fat)
						<input type="text" class="input" name="goal_body_fat" value="{{ $goals_body_fat->value }}">
					@else
						<input type="text" class="input" name="goal_body_fat">
					@endif
					<label for="" class="label">% Grasa corporal</label>
				</div>	
			</div>
			<div>
				<button type="submit" class="button button-primary">Añadir objetivos</button>
			</div>	
		</form>