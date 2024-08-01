<div class="row">
    <div class="col">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control  @error('descripcion') is-invalid @enderror" name="descripcion"
            id="descripcion" value="{{ old('descripcion', $ingreso->descripcion) }}">

        @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col">
        <label for="porcentaje">Porcentaje</label>
        <input type="number" step="0.1" min="0" max="100"
            class="form-control @error('porcentaje') is-invalid @enderror" name="porcentaje" id="porcentaje"
            value="{{ old('porcentaje', $ingreso->porcentaje) }}">

        @error('porcentaje')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col mt-3">
        <button class="btn btn-primary">{{ $button }}</button>
    </div>
</div>
