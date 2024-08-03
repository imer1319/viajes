@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tipo de comprobantes</h1>
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
            <div class="card-header">Crear tipo de comprobante</div>

            <div class="card-body">
                <form action="{{ route('admin.tipo-comprobantes.store') }}" method="POST">
                    @csrf
                    @include('admin.tipoComprobantes.form', ['button' => 'Crear'])
                </form>
            </div>
        </div>

    </section>
@endsection
