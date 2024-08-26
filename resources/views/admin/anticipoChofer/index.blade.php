@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Anticipos Chofer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.anticipos.index') }}">Listado de anticipos</a>
                        </li>
                        <li class="breadcrumb-item active">Anticipos de {{ $chofer->nombre }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3">
        <div class="card card-primary card-outline">
            <div class="mx-3 my-2 d-flex align-items-center justify-content-between">
                <h5>Listado de anticipos del chofer: <b>{{ $chofer->nombre }}</b></h5>
                <div>
                    <a href="{{ route('admin.anticipos.chofer.download.excel', $chofer) }}"
                        class="btn btn-primary rounded-pill float-end">
                        <i class="fas fa-file-excel"></i>
                    </a>
                    <a href="{{ route('admin.anticipos.chofer.create', $chofer) }}"
                        class="btn btn-primary rounded-pill float-end">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @include('admin.anticipoChofer.table')
            </div>
        </div>
    </section>
@endsection
