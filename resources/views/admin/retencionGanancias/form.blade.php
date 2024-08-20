<div class="row">
    <div class="col">
        <label for="codigo">Código</label>
        <input type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" id="codigo"
            value="{{ old('codigo', $ganancia->codigo) }}">
        @error('codigo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col">
        <label for="tipo">Tipo</label>
        <input type="text" class="form-control @error('tipo') is-invalid @enderror" name="tipo" id="tipo"
            value="{{ old('tipo', $ganancia->tipo) }}">
        @error('tipo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="minimo">Mínimo</label>
        <input type="number" class="form-control @error('minimo') is-invalid @enderror" name="minimo" id="minimo"
            value="{{ old('minimo', $ganancia->minimo) }}">
        @error('minimo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col">
        <label for="alicuota">Alicuota</label>
        <input type="number" step="0.01" class="form-control @error('alicuota') is-invalid @enderror"
            name="alicuota" id="alicuota" value="{{ old('alicuota', $ganancia->alicuota) }}">
        @error('alicuota')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="codigo_retencion">Código Retención</label>
        <input type="text" class="form-control @error('codigo_retencion') is-invalid @enderror"
            name="codigo_retencion" id="codigo_retencion"
            value="{{ old('codigo_retencion', $ganancia->codigo_retencion) }}">
        @error('codigo_retencion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col">
        <label for="codigo_afip">Código AFIP</label>
        <input type="text" class="form-control @error('codigo_afip') is-invalid @enderror" name="codigo_afip"
            id="codigo_afip" value="{{ old('codigo_afip', $ganancia->codigo_afip) }}">
        @error('codigo_afip')
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
