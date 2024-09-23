@extends('layouts.admin')

@section('title','Choferes')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Choferes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.choferes.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3">
        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Crear chofer</div>
            <div class="card-body">

                <chofer-create redirect="true" />

            </div>
        </div>

    </section>
@endsection
