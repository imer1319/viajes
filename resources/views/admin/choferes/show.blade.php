@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chofer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.choferes.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Ver chofer</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <strong><i class="fas fa-user mr-1"></i> Chofer</strong>
                        <p class="text-muted">Nombre: {{ $chofer->nombre }}</p>
                        <p class="text-muted">Fecha de nacimiento: {{ $chofer->fecha_nacimiento }}</p>
                        <p class="text-muted">Cuil : {{ $chofer->cuil }}</p>
                        <p class="text-muted">Dni: {{ $chofer->dni }}</p>
                        <p class="text-muted">Domicilio: {{ $chofer->domicilio }}</p>
                        <p class="text-muted">Email: {{ $chofer->email }}</p>
                        <p class="text-muted">Telefono: {{ $chofer->telefono }}</p>
                        <p class="text-muted">Saldo: {{ number_format($chofer->saldo, 2, ',', '.')  }}</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
