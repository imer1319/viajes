<form action="#" method="get" id="form">
    <div class="form-group row">
        <div class="col-md-3">
            <select name="forma_id" id="forma_id" class="form-control">
                <option value="" disabled selected>-- Seleccione una forma de pago --</option>
                @foreach ($formas as $forma)
                    <option value="{{ $forma->id }}" {{ request('forma_id') == $forma->id ? 'selected' : '' }}>
                        {{ $forma->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>
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
            <input type="date" class="form-control" name="desde" id="desde"
                value="{{ old('desde', request('desde')) }}">
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control" name="hasta" id="hasta"
                value="{{ old('hasta', request('hasta')) }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <span class="tts:right tts-slideIn tts-custom" aria-label="Crear liquidacion">
                <a href="{{ route('admin.liquidaciones.create') }}" class="btn btn-primary rounded-pill float-end">
                    <i class="fa fa-plus"></i>
                </a>
            </span>
            <span class="tts:right tts-slideIn tts-custom" aria-label="Exportar a excel">
                <a href="{{ route('admin.liquidacion.download.excel', request()->all()) }}"
                    class="btn btn-primary rounded-pill float-end">
                    <i class="fas fa-file-excel"></i>
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
