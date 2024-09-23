@extends('layouts.admin')

@section('title','Facturas')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liquidaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.facturaciones.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Ver liquidacio</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong><i class="fas fa-money-check mr-1"></i> Cliente</strong>
                        <p class="text-muted">Razon social: {{ $factura->cliente->razon_social }}</p>
                        <p class="text-muted">CUIT : {{ $factura->cliente->cuit }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fas fa-money-check mr-1"></i>Datos del la
                            factura</strong>
                        <p class="text-muted">Fecha: {{ $factura->fecha }}</p>
                        <p class="text-muted">Observaciones: {{ $factura->observaciones }}</p>
                    </div>
                    <div class="col-md-12">
                        <strong><i class="fa fa-bus mr-1"></i>Movimientos</strong>
                        <table class="table table-bordered col-md-12">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Tipo de viaje</th>
                                    <th>Precio real</th>
                                    <th>IVA</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($factura->detalles as $movimiento)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $movimiento->movimiento->fecha }}</td>
                                        <td>{{ $movimiento->movimiento->tipoViaje->descripcion }}</td>
                                        <td>{{ number_format($movimiento->movimiento->precio_real, 2, ',', '.') }}</td>
                                        <td>{{ number_format($movimiento->movimiento->iva, 2, ',', '.') }}</td>
                                        <td>{{ number_format($movimiento->movimiento->total, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <h5 class="text-center"><i class="fa fa-book mr-3"></i>Resumen</h5>
                        <p>Neto: {{ number_format($factura->neto, 2, ',', '.') }}</p>
                        <p>Iva: {{ number_format($factura->iva, 2, ',', '.') }}</p>
                        <p>Total: {{ number_format($factura->total, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
