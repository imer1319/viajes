<form action="#" method="get" id="form">
    <div class="form-group row">
        <div class="col-md-3">
            <select name="chofer_id" id="chofer_id" class="form-control">
                <option value="" disabled selected>-- Seleccione un chofer --</option>
                @foreach ($choferes as $chofer)
                    <option value="{{ $chofer->id }}" {{ request('chofer_id') == $chofer->id ? 'selected' : '' }}>
                        {{ $chofer->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="tipo_viaje_id" id="tipo_viaje_id" class="form-control">
                <option value="" disabled selected>-- Seleccione un tipo de viaje --</option>
                @foreach ($tipoViajes as $tipo)
                    <option value="{{ $tipo->id }}" {{ request('tipo_viaje_id') == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->descripcion }}
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
            <select name="cliente_id" id="cliente_id" class="form-control">
                <option value="" disabled selected>-- Seleccione un cliente --</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->razon_social }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 mt-3">
            <select name="facturado" id="facturado" class="form-control">
                <option value="" {{ is_null(request('facturado')) ? 'selected' : '' }} disabled> -- ¿ Facturado ?
                    --</option>
                <option value="1" {{ request('facturado') === '1' ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ request('facturado') === '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="col-md-3 mt-3">
            <input type="date" class="form-control" name="desde" id="desde"
                value="{{ old('desde', request('desde')) }}">
        </div>
        <div class="col-md-3 mt-3">
            <input type="date" class="form-control" name="hasta" id="hasta"
                value="{{ old('hasta', request('hasta')) }}">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
            <span class="tts:right tts-slideIn tts-custom" aria-label="Crear movimiento">
                <a href="{{ route('admin.movimientos.create') }}" class="btn btn-primary rounded-pill float-end">
                    <i class="fa fa-plus"></i>
                </a>
            </span>
            <span class="tts:right tts-slideIn tts-custom" aria-label="Exportar a excel">
                <a href="{{ route('admin.movimiento.download.excel', request()->all()) }}"
                    class="btn btn-primary rounded-pill float-end">
                    <i class="fas fa-file-excel"></i>
                </a>
            </span>
            <span class="tts:right tts-slideIn tts-custom" aria-label="Imprimir">
                <a href="{{ route('admin.movimiento.download.print', request()->all()) }}" target="_blank"
                    class="btn btn-primary rounded-pill float-end">
                    <i class="fas fa-print"></i>
                </a>
            </span>
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
