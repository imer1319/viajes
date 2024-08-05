<div class="row">
    <div class="col-md-6">
        <label for="codigo">Codigo</label>
        <input type="text" class="form-control  @error('codigo') is-invalid @enderror" name="codigo"
            id="codigo" value="{{ old('codigo', $condicion->codigo) }}">
        @error('codigo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control  @error('descripcion') is-invalid @enderror" name="descripcion"
            id="descripcion" value="{{ old('descripcion', $condicion->descripcion) }}">
        @error('descripcion')
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
