@extends('layouts.admin')

@section('title', 'Flotas')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Flotas</h1>
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
                <h5>Listado de flotas</h5>
                <span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Imprimir">
                        <a href="{{ route('admin.flota.download.print') }}" target="_blank" class="btn btn-primary rounded-pill float-end">
                            <i class="fas fa-print"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Crear flota">
                        <a href="{{ route('admin.flotas.create') }}" class="btn btn-primary rounded-pill float-end">
                            <i class="fa fa-plus"></i>
                        </a>
                    </span>
                </span>
            </div>
            <div class="card-body">
                @include('admin.flotas.table')
            </div>
        </div>
    </section>
@endsection
