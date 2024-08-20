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
                        <li class="breadcrumb-item"><a href="{{ route('admin.gastos.chofer.index', $chofer->id) }}">Gastos de {{ $chofer->nombre }}</a></li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">
        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Crear gasto</div>
            <div class="card-body">

                <gasto-create :numero_interno="{{ $numero_interno }}" redirect="true" :chofer_id="{{ $chofer->id }}" />
                
            </div>
        </div>

    </section>
@endsection
