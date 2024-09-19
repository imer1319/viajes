<form action="#" method="get" id="form">
    <div class="form-group row">
        <div class="col-md-3">
            <select name="cliente_id" id="cliente_id" class="form-control">
                <option value="" disabled selected>-- Seleccione un chofer --</option>
                @foreach ($choferes as $chofer)
                    <option value="{{ $chofer->id }}" {{ request('cliente_id') == $chofer->id ? 'selected' : '' }}>
                        {{ $chofer->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="flota_id" id="flota_id" class="form-control">
                <option value="" disabled selected>-- Seleccione una flota --</option>
                @foreach ($flotas as $flota)
                    <option value="{{ $flota->id }}" {{ request('flota_id') == $flota->id ? 'selected' : '' }}>
                        {{ $flota->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control" name="desde" id="desde"
                value="{{ old('desde', request('desde')) }}">
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control" name="hasta" id="hasta"
                value="{{ old('hasta', request('hasta')) }}">
        </div>
        <div class="col-md-3 mt-3">
            <select name="saldo" id="saldo" class="form-control">
                <option value="" {{ is_null(request('saldo')) ? 'selected' : '' }} disabled> -- ¿ Saldo ? --
                </option>
                <option value="1" {{ request('saldo') === '1' ? 'selected' : '' }}>Con saldo</option>
                <option value="0" {{ request('saldo') === '0' ? 'selected' : '' }}>Sin saldo</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
            <a href="{{ route('admin.gastos.create') }}" class="btn btn-primary rounded-pill float-end">
                <i class="fa fa-plus"></i>
            </a>
            <a href="{{ route('admin.gastos.download.excel', request()->all()) }}"
                class="btn btn-primary rounded-pill float-end">
                <i class="fas fa-file-excel"></i>
            </a>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-primary font-verdana btn-sm" type="button" onclick="search();">
                <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Buscar
            </button>
            <button class="btn btn-primary font-verdana btn-sm" type="button" onclick="limpiar();">
                &nbsp;<i class="fa fa-eraser"></i>&nbsp;Limpiar
            </button>
            <i class="fa fa-spinner custom-spinner fa-spin fa-2x fa-fw spinner-btn" style="display: none;"></i>
        </div>
    </div>
</form>
