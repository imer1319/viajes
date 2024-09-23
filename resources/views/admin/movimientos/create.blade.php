@extends('layouts.admin')
@section('title', 'Movimientos')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Movimientos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.movimientos.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content mx-3">
        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Crear movimiento</div>
            <div class="card-body">
                <movimiento-create :numero_interno="{{ $numero_interno }}" :choferes_data="{{ $choferes }}"
                    :flotas_data="{{ $flotas }}" :tipo_viajes_data="{{ $tipoViajes }}"
                    :retencion_ganancias="{{ $retencionGanancias }}" :provincias="{{ $provincias }}"
                    :retencion_ingresos_bruto="{{ $retencionIngresosBruto }}" :tipo_documentos="{{ $tipoDocumentos }}"
                    :condiciones_iva="{{ $condicionesIva }}" 
                    :clientes_data="{{ $clientes }}" />
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $('.select2').select2()
    </script>
@endsection
