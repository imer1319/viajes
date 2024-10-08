@extends('layouts.admin')

@section('title','Gastos')

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

                <gasto-create :tipo_gastos_data="{{ $tipoGastos }}" :numero_interno="{{ $numero_interno }}"
                    redirect="true" />

            </div>
        </div>

    </section>
@endsection
