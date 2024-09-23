@extends('layouts.admin')

@section('title','Formas de pago')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Formas de pago</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.forma-pagos.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Crear forma de pago</div>

            <div class="card-body">
                <form action="{{ route('admin.forma-pagos.store') }}" method="POST">
                    @csrf
                    @include('admin.formaPagos.form', ['button' => 'Crear'])
                </form>
            </div>
        </div>

    </section>
@endsection
