@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gastos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.gastos.index') }}">Listado</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.gastos.chofer.index',$chofer->id) }}">Gastos de {{ $chofer->nombre }}</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Ver gasto</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <strong><i class="fas fa-money-check mr-1"></i> Gasto</strong>
                        <p class="text-muted">Numero interno: {{ $gasto->numero_interno }}</p>
                        <p class="text-muted">Chofer: {{ $gasto->chofer->nombre }}</p>
                        <p class="text-muted">Proveedor: {{ $gasto->proveedor->razon_social }}</p>
                        <p class="text-muted">Flota: {{ $gasto->flota->nombre }}</p>
                        <p class="text-muted">Importe: {{ $gasto->importe }}</p>
                        <p class="text-muted">Saldo: {{ $gasto->saldo }}</p>
                        <p class="text-muted">Detalle: {{ $gasto->detalle }}</p>
                    </div>
                    <div class="col-7">
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
