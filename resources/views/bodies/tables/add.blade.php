    <h5 class="mb-4 mt-4">Añadir medición</h5>
    <form action="{{ route('bodies.store') }}" method="POST" autocomplete="off">
        <div class="row" style="margin-bottom: 40px;">
        	@csrf
            <div class=" col field-outlined">
                <input type="text" class="input" name="weight">
                <label for="" class="label">Peso</label>
            </div>
            <div class=" col field-outlined">
                <input type="text" class="input" name="body_fat">
                <label for="" class="label">% Grasa corporal</label>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <button type="submit" class="boton boton-primary">Añadir</button>
            </div>
        </div>
    </form>