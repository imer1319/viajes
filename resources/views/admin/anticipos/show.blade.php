@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Anticipos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Ver anticipo</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <strong><i class="fas fa-money-check mr-1"></i> Movimiento</strong>
                        <p class="text-muted">Numero interno {{ $anticipo->numero_interno }}</p>
                        <p class="text-muted">Fecha {{ $anticipo->fecha }}</p>
                        <p class="text-muted">Chofer_id {{ $anticipo->chofer_id }}</p>
                        <p class="text-muted">Importe {{ $anticipo->importe }}</p>
                        <p class="text-muted">Saldo {{ $anticipo->saldo }}</p>
                    </div>
                    <div class="col-7">
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection