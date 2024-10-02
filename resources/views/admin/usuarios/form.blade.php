<div class="row">
    <div class="col-md-6">
        <label for="name">Nombre</label>
        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name"
            value="{{ old('name', $user->name) }}">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="email">Email</label>
        <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" id="email"
            value="{{ old('email', $user->email) }}">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="password">Contraseña</label>

        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <label for="password-confirm">Confirmar contraseña</label>

        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>
    </div>
    {{-- <div class="col-md-6">
        <label for="role_id">Rol</label>
        <div>
            @foreach ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input @error('role_id') is-invalid @enderror" type="radio" name="role_id"
                        id="role_{{ $role->id }}" value="{{ $role->id }}"
                        {{ old('role_id', $user->roles->first()->id ?? '') == $role->id ? 'checked' : '' }}>
                    <label class="form-check-label" for="role_{{ $role->id }}">
                        {{ $role->description }}
                    </label>
                </div>
            @endforeach

            @error('role_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div> --}}
</div>
<div class="row">
    <div class="col mt-3">
        <button class="btn btn-primary">{{ $button }}</button>
    </div>
</div>
