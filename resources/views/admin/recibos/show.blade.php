@extends('layouts.admin')

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

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Ver liquidacio</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <strong><i class="fas fa-money-check mr-1"></i> Movimiento</strong>
                        <p class="text-muted">Estado: {{ $liquidacion->estado = 1 ? 'ACTIVO' : 'INACTIVO' }}</p>
                    </div>
                    <div class="col-7">
                        <strong><i class="fas fa-comments-dollar mr-1"></i> Condicion IVA</strong>
                        <hr>
                        <strong><i class="fas fa-map-marker mr-1"></i> Ubicacion</strong>
                        <p class="text-muted">Domicilio: {{ $liquidacion->domicilio }}</p>
                        <p class="text-muted">Codigo postal: {{ $liquidacion->codigo_postal }}</p>
                        <hr>
                        <strong><i class="fas fa-chart-area mr-1"></i> Retencion de ganancia</strong>
                        <hr>
                        <strong><i class="fas fa-keyboard mr-1"></i> Retencion de ingreso bruto</strong>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
