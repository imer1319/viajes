@extends('layouts.admin')

@section('title', 'Inicio')

@section('content')
    <section class="content-header">
        <div class="container-fluid">

        </div>
    </section>

    <section class="content mx-3">
        <div class="card ">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 elevation-1">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-truck"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Movimientos con saldo</span>
                                <span class="info-box-number h3">{{ $total_movimientos->con_saldo }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 elevation-1">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-truck"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Movimientos sin saldo</span>
                                <span class="info-box-number h3">{{ $total_movimientos->sin_saldo }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 elevation-1">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Clientes con saldo</span>
                                <span class="info-box-number h3">{{ $clientes_saldo }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 elevation-1">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Choferes con saldo</span>
                                <span class="info-box-number h3">{{ $choferes_saldo }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline elevation-1">
                            <div class="card-header">
                                <h5>Clientes con mas movimientos</h5>
                                <form action="#" method="get" id="form-cliente">
                                    <div class="row">
                                        <div class="col-md-4 mt-3">
                                            <input type="date" class="form-control" name="desde" id="desde"
                                                value="{{ old('desde', request('desde')) }}">
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <input type="date" class="form-control" name="hasta" id="hasta"
                                                value="{{ old('hasta', request('hasta')) }}">
                                        </div>
                                        <div class="col-md-4 mt-3 text-right">
                                            <button class="btn btn-primary font-verdana btn-sm" type="button"
                                                onclick="searchCliente();">
                                                <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Buscar
                                            </button>
                                            <button class="btn btn-primary font-verdana btn-sm" type="button"
                                                onclick="limpiar();">
                                                &nbsp;<i class="fa fa-eraser"></i>&nbsp;Limpiar
                                            </button>
                                            <i class="fa fa-spinner custom-spinner fa-spin fa-2x fa-fw spinner-btn"
                                                style="display: none;"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>Cliente</th>
                                        <th>Saldo cliente</th>
                                        <th>Total importe</th>
                                        <th>Movimientos</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($clientes as $cliente)
                                            <tr>
                                                <td width="10px">{{ $loop->iteration }}</td>
                                                <td>{{ $cliente->razon_social }}</td>
                                                <td>{{ number_format($cliente->saldo, 2, ',', '.') }}</td>
                                                <td>{{ number_format($cliente->movimientos_sum_total, 2, ',', '.') }}</td>
                                                <td width="10px" align="center">{{ $cliente->movimientos_count }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td align="center" colspan="5">No se encontraron clientes</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"><strong>Total</strong></td>
                                            <td><strong>{{ number_format($totales['saldo_cliente'], 2, ',', '.') }}</strong>
                                            </td>
                                            <td><strong>{{ number_format($totales['saldo_cliente'], 2, ',', '.') }}</strong>
                                            </td>
                                            <td align="center"><strong>{{ $totales['total_movimientos_cliente'] }}</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary card-outline elevation-1">
                            <div class="card-header">
                                <h5>Choferes con mas comisión</h5>
                                <form action="#" method="get" id="form-chofer">
                                    <div class="row">
                                        <div class="col-md-4 mt-3">
                                            <input type="date" class="form-control" name="desde" id="desde"
                                                value="{{ old('desde', request('desde')) }}">
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <input type="date" class="form-control" name="hasta" id="hasta"
                                                value="{{ old('hasta', request('hasta')) }}">
                                        </div>
                                        <div class="col-md-4 mt-3 text-right">
                                            <button class="btn btn-primary font-verdana btn-sm" type="button"
                                                onclick="searchChofer();">
                                                <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Buscar
                                            </button>
                                            <button class="btn btn-primary font-verdana btn-sm" type="button"
                                                onclick="limpiar();">
                                                &nbsp;<i class="fa fa-eraser"></i>&nbsp;Limpiar
                                            </button>
                                            <i class="fa fa-spinner custom-spinner fa-spin fa-2x fa-fw spinner-btn"
                                                style="display: none;"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>Cliente</th>
                                        <th>Saldo chofer</th>
                                        <th>Total comision</th>
                                        <th>Movimientos</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($choferes as $chofer)
                                            <tr>
                                                <td width="10px">{{ $loop->iteration }}</td>
                                                <td>{{ $chofer->nombre }}</td>
                                                <td>{{ number_format($chofer->saldo, 2, ',', '.') }}</td>
                                                <td>{{ number_format($chofer->movimientos_sum_comision_chofer, 2, ',', '.') }}
                                                </td>
                                                <td width="10px" align="center">{{ $chofer->movimientos_count }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td align="center" colspan="5">No se encontraron movimientos</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"><strong>Total</strong></td>
                                            <td><strong>{{ number_format($totales['saldo_chofer'], 2, ',', '.') }}</strong>
                                            </td>
                                            <td><strong>{{ number_format($totales['total_comision'], 2, ',', '.') }}</strong>
                                            </td>
                                            <td align="center"><strong>{{ $totales['total_movimientos_chofer'] }}</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary card-outline elevation-1">
                            <div class="card-header">
                                <h5>Flotas con mas movimientos</h5>
                                <form action="#" method="get" id="form-flota">
                                    <div class="row">
                                        <div class="col-md-4 mt-3">
                                            <input type="date" class="form-control" name="desde" id="desde"
                                                value="{{ old('desde', request('desde')) }}">
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <input type="date" class="form-control" name="hasta" id="hasta"
                                                value="{{ old('hasta', request('hasta')) }}">
                                        </div>
                                        <div class="col-md-4 mt-3 text-right">
                                            <button class="btn btn-primary font-verdana btn-sm" type="button"
                                                onclick="searchFlota();">
                                                <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Buscar
                                            </button>
                                            <button class="btn btn-primary font-verdana btn-sm" type="button"
                                                onclick="limpiar();">
                                                &nbsp;<i class="fa fa-eraser"></i>&nbsp;Limpiar
                                            </button>
                                            <i class="fa fa-spinner custom-spinner fa-spin fa-2x fa-fw spinner-btn"
                                                style="display: none;"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>Flota</th>
                                        <th>Marca</th>
                                        <th>Placa</th>
                                        <th>Movimientos</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($flotas as $flota)
                                            <tr>
                                                <td width="10px">{{ $loop->iteration }}</td>
                                                <td>{{ $flota->nombre }}</td>
                                                <td>{{ $flota->marca }}</td>
                                                <td>{{ $flota->placa }}</td>
                                                <td align="center">{{ $flota->movimientos_count }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td align="center" colspan="5">No se encontraron movimientos</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"><strong>Total</strong></td>
                                            <td align="center"><strong>{{ $totales['total_movimientos_flota'] }}</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary card-outline elevation-1">
                            <div class="card-header">
                                <h5>Tipos de viaje con mas movimientos</h5>
                                <form action="#" method="get" id="form-tipo">
                                    <div class="row">
                                        <div class="col-md-4 mt-3">
                                            <input type="date" class="form-control" name="desde" id="desde"
                                                value="{{ old('desde', request('desde')) }}">
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <input type="date" class="form-control" name="hasta" id="hasta"
                                                value="{{ old('hasta', request('hasta')) }}">
                                        </div>
                                        <div class="col-md-4 mt-3 text-right">
                                            <button class="btn btn-primary font-verdana btn-sm" type="button"
                                                onclick="searchTipo();">
                                                <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Buscar
                                            </button>
                                            <button class="btn btn-primary font-verdana btn-sm" type="button"
                                                onclick="limpiar();">
                                                &nbsp;<i class="fa fa-eraser"></i>&nbsp;Limpiar
                                            </button>
                                            <i class="fa fa-spinner custom-spinner fa-spin fa-2x fa-fw spinner-btn"
                                                style="display: none;"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>Descripcion</th>
                                        <th>Movimientos</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($tipos as $tipo)
                                            <tr>
                                                <td width="10px">{{ $loop->iteration }}</td>
                                                <td>{{ $tipo->descripcion }}</td>
                                                <td align="center" width="10px">{{ $tipo->movimientos_count }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td align="center" colspan="4">No se encontraron movimientos</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"><strong>Total</strong></td>
                                            <td align="center"><strong>{{ $totales['total_movimientos_tipo'] }}</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script type="text/javascript">
    function searchCliente() {
        var url = "{{ route('home.searchCliente') }}";
        $("#form-cliente").attr('action', url);
        $(".btn").hide();
        $(".btn-importar").hide();
        // $(".spinner-btn").show();
        $("#form-cliente").submit();
    }

    function searchChofer() {
        var url = "{{ route('home.searchChofer') }}";
        $("#form-chofer").attr('action', url);
        $(".btn").hide();
        $(".btn-importar").hide();
        // $(".spinner-btn").show();
        $("#form-chofer").submit();
    }

    function searchFlota() {
        var url = "{{ route('home.searchFlota') }}";
        $("#form-flota").attr('action', url);
        $(".btn").hide();
        $(".btn-importar").hide();
        // $(".spinner-btn").show();
        $("#form-flota").submit();
    }
    function searchTipo() {
        var url = "{{ route('home.searchTipo') }}";
        $("#form-tipo").attr('action', url);
        $(".btn").hide();
        $(".btn-importar").hide();
        // $(".spinner-btn").show();
        $("#form-tipo").submit();
    }

    function limpiar() {
        $(".btn").hide();
        $(".btn-importar").hide();
        // $(".spinner-btn").show();
        window.location.href = "{{ route('home') }}";
    }
</script>
