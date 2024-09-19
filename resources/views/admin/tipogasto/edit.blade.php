@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tipos de gasto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.tipos-gasto.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Editar tipo de gasto</div>

            <div class="card-body">
                <form action="{{ route('admin.tipos-gasto.update', $tipos_gasto) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.tipogasto.form', ['button' => 'Actualizar'])
                </form>
            </div>
        </div>

    </section>
@endsection
