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
        </div>
    </section>

    <section class="content mx-3">
        <div class="card card-primary card-outline">
            <div class="mx-3 my-2 d-flex align-items-center justify-content-between">
                @if (isset($chofer))
                    <h5>Listado de anticipos del chofer: <b>{{ $chofer->nombre }}</b></h5>
                @else
                    <h5>Listado de anticipos</h5>
                @endif
                <a href="{{ route('admin.anticipos.create') }}" class="btn btn-primary rounded-pill float-end">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                @include('admin.anticipos.table')
            </div>
        </div>
    </section>
@endsection