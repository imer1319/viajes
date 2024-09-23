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
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">
        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Crear factura</div>
            <div class="card-body">
                <factura-create :clientes_data="{{ $clientes }}" :numero_interno="{{ $numero_interno }}"
                    :condiciones_iva_data="{{ $condicionesIva }}" :provincias_data="{{ $provincias }}"
                    :retencion_ganancias_data="{{ $retencionGanancias }}"
                    :retencion_ingresos_bruto_data="{{ $retencionIngresosBruto }}"
                    :condiciones_pago_data="{{ $condicionesPago }}" :tipo_documentos_data="{{ $tipoDocumentos }}"
                    :sugerencia_numero_factura_1="'{{ $sugerenciaNumeroFactura1 }}'"
                    :sugerencia_numero_factura_2="'{{ $sugerenciaNumeroFactura2 }}'" />
            </div>
        </div>

    </section>
@endsection
