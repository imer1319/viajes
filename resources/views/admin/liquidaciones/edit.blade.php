@extends('layouts.admin')

@section('title','Liquidaciones')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liquidacion</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.liquidaciones.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Editar liquidacion</div>

            <div class="card-body">
                <liquidacion-edit :liquidacion="{{ $liquidacion }}" :choferes="{{ $choferes }}"
                    :numero_interno="{{ $liquidacion->numero_interno }}" redirect="true" :forma_pagos="{{ $formaPagos }}"
                    :bancos="{{ $bancos }}" />
            </div>
        </div>

    </section>
@endsection
