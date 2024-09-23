@extends('layouts.admin')

@section('title','Recibos')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Recibos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.recibos.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">
        <div class="card card-primary card-outline">
            <div class="card-header">Ver recibo</div>
            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center">
                                    <p>FACTURAS DEL CLIENTE</p>
                                </th>
                            </tr>
                            <tr>
                                <th>Ord</th>
                                <th>Fecha</th>
                                <th># Factura</th>
                                <th>Importe</th>
                                <th>Saldo total</th>
                                <th>Pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalFactura = 0;
                            @endphp

                            @foreach ($recibo->facturas as $factura)
                                @php
                                    $totalFactura += $factura->pago;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $factura->factura->fecha }}</td>
                                    <td>{{ $factura->factura->numero_factura_1 }}-{{ $factura->factura->numero_factura_2 }}</td>
                                    <td>
                                        {{ number_format($factura->factura->total, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ number_format($factura->factura->saldo_total, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ number_format($factura->pago, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5">Total</th>
                                <th>
                                    <b>{{ number_format($totalFactura, 2, ',', '.') }}</b>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="7" class="text-center">
                                    <p>FORMAS DE PAGO</p>
                                </th>
                            </tr>
                            <tr>
                                <th>Ord</th>
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

                            @foreach ($recibo->pagos as $pago)
                                @php
                                    $totalPago += $pago->importe;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pago->nro }}</td>
                                    <td>{{ $pago->abreviacion }}</td>
                                    <td>{{ $pago->descripcion }}</td>
                                    <td>{{ $pago->fecha_emision }}</td>
                                    <td>{{ $pago->fecha_vencimiento }}</td>
                                    <td>
                                        {{ number_format($pago->importe, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6">Total</th>
                                <th>
                                    <b>{{ number_format($totalPago, 2, ',', '.') }}</b>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    <table>
                        <tr>
                            <td align="right">
                                <span>CANCELACION:
                                    {{ number_format($recibo->total_recibo, 2, ',', '.') }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td>Observaciones:</td>
                            <td>{{ $recibo->observaciones }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
