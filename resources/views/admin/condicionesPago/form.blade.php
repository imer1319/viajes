<div class="row">
    <div class="col-md-6">
        <label for="condicion">Condicion</label>
        <input type="text" class="form-control  @error('condicion') is-invalid @enderror" name="condicion"
            id="condicion" value="{{ old('condicion', $condicion->condicion) }}">
        @error('condicion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="dias">Dias</label>
        <input type="number" class="form-control  @error('dias') is-invalid @enderror" name="dias"
            id="dias" value="{{ old('dias', $condicion->dias) }}">
        @error('dias')
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
