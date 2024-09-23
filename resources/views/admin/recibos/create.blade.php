@extends('layouts.admin')

@section('title','Recibos')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Recibos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.recibos.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">
        <div class="card card-primary card-outline">
            <div class="card-header">Crear recibo</div>
            <div class="card-body">

                <recibo-create :clientes_data="{{ $clientes }}" :numero_interno="{{ $numero_interno }}"
                    :condiciones_iva_data="{{ $condicionesIva }}" :provincias_data="{{ $provincias }}"
                    :retencion_ganancias_data="{{ $retencionGanancias }}"
                    :retencion_ingresos_bruto_data="{{ $retencionIngresosBruto }}"
                    :tipo_documentos_data="{{ $tipoDocumentos }}" :forma_pagos="{{ $formaPagos }}"
                    :bancos="{{ $bancos }}" />
            </div>
        </div>

    </section>
@endsection
