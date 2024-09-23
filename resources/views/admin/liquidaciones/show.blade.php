@extends('layouts.admin')

@section('title','Liquidaciones')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liquidaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.liquidaciones.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">
        <div class="card card-primary card-outline">
            <div class="card-header">Ver liquidacio</div>
            <div class="card-body">
                <div class="row">

                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center">
                                    <p>MOVIMIENTOS DEL CHOFER</p>
                                </th>
                            </tr>
                            <tr>
                                <th>Ord</th>
                                <th>Nro</th>
                                <th>Fecha</th>
                                <th>Precio Chofer</th>
                                <th>%</th>
                                <th>Comisión Chofer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalLiquidacionMovimiento = 0;
                            @endphp

                            @foreach ($liquidacion->movimientos as $movimiento)
                                @php
                                    $totalLiquidacionMovimiento += $movimiento->movimiento->comision_chofer;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $movimiento->id }}</td>
                                    <td>{{ $movimiento->fecha }}</td>
                                    <td>
                                        {{ number_format($movimiento->movimiento->precio_chofer, 2, ',', '.') }}
                                    </td>
                                    <td>{{ $movimiento->movimiento->porcentaje_pago }}</td>
                                    <td>
                                        {{ number_format($movimiento->movimiento->comision_chofer, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5">Total</th>
                                <th>
                                    <b>{{ number_format($totalLiquidacionMovimiento, 2, ',', '.') }}</b>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="5" class="text-center">
                                    <p>ANTICIPOS DEL CHOFER</p>
                                </th>
                            </tr>
                            <tr>
                                <th>Ord</th>
                                <th>Nro</th>
                                <th>Fecha</th>
                                <th>Imp Anticipo</th>
                                <th>Pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalLiquidacionAnticipo = 0;
                            @endphp

                            @foreach ($liquidacion->anticipos as $anticipo)
                                @php
                                    $totalLiquidacionAnticipo += $anticipo->importe;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $anticipo->anticipo->id }}</td>
                                    <td>{{ $anticipo->anticipo->fecha }}</td>
                                    <td>
                                        {{ number_format($anticipo->anticipo->importe, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ number_format($anticipo->importe, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total</th>
                                <th>
                                    <b>{{ number_format($totalLiquidacionAnticipo, 2, ',', '.') }}</b>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center">
                                    <p>GASTOS VARIOS</p>
                                </th>
                            </tr>
                            <tr>
                                <th>Ord</th>
                                <th>Nro</th>
                                <th>Fecha</th>
                                <th>Camion</th>
                                <th>Imp Gasto</th>
                                <th>Pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalLiquidacionGasto = 0;
                            @endphp

                            @foreach ($liquidacion->gastos as $gasto)
                                @php
                                    $totalLiquidacionGasto += $gasto->importe;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $gasto->id }}</td>
                                    <td>{{ $gasto->gasto->fecha }}</td>
                                    <td>{{ $gasto->gasto->flota->nombre }}</td>
                                    <td>
                                        {{ number_format($gasto->gasto->importe, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ number_format($gasto->importe, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5">Total</th>
                                <th>
                                    {{ number_format($totalLiquidacionGasto, 2, ',', '.') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center">
                                    <p>FORMAS DE PAGO</p>
                                </th>
                            </tr>
                            <tr>
                                <th>Numero</th>
                                <th>Forma</th>
                                <th>Descripcion</th>
                                <th>Fecha emision</th>
                                <th>Fecha vencimiento</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalPago = 0;
                            @endphp
                            @foreach ($liquidacion->pagos as $pago)
                                @php
                                    $totalPago += $pago->importe;
                                @endphp
                                <tr>
                                    <td>{{ $pago->nro }}</td>
                                    <td>{{ $pago->abreviacion }}</td>
                                    <td>{{ $pago->descripcion }}</td>
                                    <td>{{ $pago->fecha_emision }}</td>
                                    <td>{{ $pago->fecha_vencimiento }}</td>
                                    <td>{{ number_format($pago->importe, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5">Total</th>
                                <th>
                                    {{ number_format($totalPago, 2, ',', '.') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    <table>
                        <tr>
                            <td align="right">
                                <span>CANCELACION:
                                    {{ number_format($liquidacion->total_liquidacion, 2, ',', '.') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ $numero_letra }}</th>
                        </tr>
                        <tr>
                            <td>Observaciones:</td>
                            <td>{{ $liquidacion->observaciones }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
