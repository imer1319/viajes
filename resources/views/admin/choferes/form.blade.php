<div class="row">
    <div class="col-md-6">
        <label for="name">Nombre</label>
        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name"
            value="{{ old('name', $cliente->name) }}">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="email">Email</label>
        <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" id="email"
            value="{{ old('email', $cliente->email) }}">
        @error('email')
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
