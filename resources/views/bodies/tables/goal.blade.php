    <h5 class="mb-4 mt-4">Añadir objetivos</h5>
    <form action="{{ route('goals.store') }}" method="POST" autocomplete="off">
        <div class="row" style="margin-bottom: 40px;">
        	@csrf
            <div class=" col field-outlined">
                @if($goals_weight)
                    <input type="text" class="input" name="goal_weight" value="{{ $goals_weight->value }}">
                @else
                    <input type="text" class="input" name="goal_weight">
                @endif
                <label for="" class="label">Peso</label>
            </div>
            <div class=" col field-outlined">
                @if($goals_body_fat)
                    <input type="text" class="input" name="goal_body_fat" value="{{ $goals_body_fat->value }}">
                @else
                    <input type="text" class="input" name="goal_body_fat">
                @endif
                <label for="" class="label">% Grasa corporal</label>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <button type="submit" class="boton boton-primary">Añadir objetivos</button>
            </div>
        </div>
    </form>

