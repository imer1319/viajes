@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Listado</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3">
        <div class="card card-primary card-outline">
            <div class="mx-3 my-2 d-flex align-items-center justify-content-between">
                <h5>Listado de clientes</h5>
                <div>
                    <a href="{{ route('admin.clientes.download.excel') }}" class="btn btn-primary rounded-pill float-end">
                        <i class="fas fa-file-excel"></i>
                    </a>
                    <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary rounded-pill float-end">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @include('admin.clientes.table')
            </div>
        </div>
    </section>
@endsection
