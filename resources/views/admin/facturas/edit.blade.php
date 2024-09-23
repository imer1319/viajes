@extends('layouts.admin')

@section('title','Facturas')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Facturas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.facturaciones.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline">
            <div class="card-header">Editar factura</div>

            <div class="card-body">
                <factura-edit :factura="{{ $factura }}" :clientes_data="{{ $clientes }}"
                    :condiciones_iva_data="{{ $condicionesIva }}"
                    :provincias_data="{{ $provincias }}" :retencion_ganancias_data="{{ $retencionGanancias }}"
                    :retencion_ingresos_bruto_data="{{ $retencionIngresosBruto }}"
                    :condiciones_pago_data="{{ $condicionesPago }}" :tipo_documentos_data="{{ $tipoDocumentos }}" />
            </div>
        </div>

    </section>
@endsection
