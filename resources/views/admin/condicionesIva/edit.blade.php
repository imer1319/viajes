@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Condiciones IVA</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.condiciones-iva.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Editar condicion IVA</div>

            <div class="card-body">
                <form action="{{ route('admin.condiciones-iva.update', $condicion) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.condicionesIva.form', ['button' => 'Actualizar'])
                </form>
            </div>
        </div>

    </section>
@endsection
