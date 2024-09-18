<form action="#" method="get" id="form">
    <div class="form-group row">
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
            <a href="{{ route('admin.recibos.create') }}" class="btn btn-primary rounded-pill float-end">
                <i class="fa fa-plus"></i>
            </a>
            <a href="{{ route('admin.recibo.download.excel', request()->all()) }}"
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
