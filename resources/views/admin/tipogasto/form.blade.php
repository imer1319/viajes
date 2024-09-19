<div class="row">
    <div class="col-md-12">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control  @error('descripcion') is-invalid @enderror" name="descripcion"
            id="descripcion" value="{{ old('descripcion', $tipos_gasto->descripcion) }}">
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
