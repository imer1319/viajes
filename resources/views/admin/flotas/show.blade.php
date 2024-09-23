@extends('layouts.admin')

@section('title','Flotas')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Flota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.flotas.index') }}">Listado</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.flotas.index') }}">Ver</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Ver flota</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <strong><i class="fas fa-bus mr-1"></i> Flota</strong>
                        <p class="text-muted">Nombre: {{ $flota->nombre }}</p>
                        <p class="text-muted">Placa: {{ $flota->placa }}</p>
                        <p class="text-muted">Marca: {{ $flota->marca }}</p>
                        <p class="text-muted">Año: {{ $flota->anio }}</p>
                        <p class="text-muted">Kilometraje: {{ $flota->kilometraje }}</p>
                        <p class="text-muted">Identificacion: {{ $flota->identificacion }}</p>
                    </div>
                    <div class="col-7">
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
