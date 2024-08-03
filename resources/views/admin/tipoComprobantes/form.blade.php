<div class="row">
    <div class="col-md-6">
        <label for="codigo">Codigo</label>
        <input type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" id="codigo"
            value="{{ old('codigo', $comprobante->codigo) }}">

        @error('codigo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control  @error('descripcion') is-invalid @enderror" name="descripcion"
            id="descripcion" value="{{ old('descripcion', $comprobante->descripcion) }}">
        @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="liquida_iva">Liquidación IVA</label>
        <div class="form-check">
            <input type="radio" class="form-check-input @error('liquida_iva') is-invalid @enderror" name="liquida_iva"
                id="liquida_iva_si" value="1"
                {{ old('liquida_iva', $comprobante->liquida_iva) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="liquida_iva_si">Sí</label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input @error('liquida_iva') is-invalid @enderror" name="liquida_iva"
                id="liquida_iva_no" value="0"
                {{ old('liquida_iva', $comprobante->liquida_iva) == '0' ? 'checked' : '' }}>
            <label class="form-check-label" for="liquida_iva_no">No</label>
        </div>
        @error('liquida_iva')
            <span class="invalid-feedback d-block">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="emite">Emite</label>
        <div class="form-check">
            <input type="radio" class="form-check-input @error('emite') is-invalid @enderror" name="emite"
                id="emite_si" value="1"
                {{ old('emite', $comprobante->emite) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="emite_si">Sí</label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input @error('emite') is-invalid @enderror" name="emite"
                id="emite_no" value="0"
                {{ old('emite', $comprobante->emite) == '0' ? 'checked' : '' }}>
            <label class="form-check-label" for="emite_no">No</label>
        </div>
        @error('emite')
            <span class="invalid-feedback d-block">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="recibe">Recibe</label>
        <div class="form-check">
            <input type="radio" class="form-check-input @error('recibe') is-invalid @enderror" name="recibe"
                id="recibe_si" value="1"
                {{ old('recibe', $comprobante->recibe) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="recibe_si">Sí</label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input @error('recibe') is-invalid @enderror" name="recibe"
                id="recibe_no" value="0"
                {{ old('recibe', $comprobante->recibe) == '0' ? 'checked' : '' }}>
            <label class="form-check-label" for="recibe_no">No</label>
        </div>
        @error('recibe')
            <span class="invalid-feedback d-block">
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
