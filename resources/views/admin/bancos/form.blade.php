<div class="row">
    <div class="col-md-6">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control  @error('descripcion') is-invalid @enderror" name="descripcion"
            id="descripcion" value="{{ old('descripcion', $banco->descripcion) }}">
        @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="domicilio">Domicilio</label>
        <input type="text" class="form-control  @error('domicilio') is-invalid @enderror" name="domicilio"
            id="domicilio" value="{{ old('domicilio', $banco->domicilio) }}">
        @error('domicilio')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="numero_cuenta">Numero de cuenta</label>
        <input type="text" class="form-control  @error('numero_cuenta') is-invalid @enderror" name="numero_cuenta"
            id="numero_cuenta" value="{{ old('numero_cuenta', $banco->numero_cuenta) }}">
        @error('numero_cuenta')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="cbu">CBU</label>
        <input type="text" class="form-control  @error('cbu') is-invalid @enderror" name="cbu" id="cbu"
            value="{{ old('cbu', $banco->cbu) }}">
        @error('cbu')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="alias">Alias</label>
        <input type="text" class="form-control  @error('alias') is-invalid @enderror" name="alias" id="alias"
            value="{{ old('alias', $banco->alias) }}">
        @error('alias')
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
