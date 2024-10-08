@extends('layouts.admin')

@section('title','Clientes')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.clientes.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Crear cliente</div>

            <div class="card-body">
                <form action="{{ route('admin.clientes.store') }}" method="POST">
                    @csrf
                    <cliente-create :retencion_ganancias="{{ $retencionGanancias }}" :provincias="{{ $provincias }}"
                        :condiciones_iva="{{ $condicionesIva }}" :retencion_ingresos_bruto="{{ $retencionIngresosBruto }}"
                        :tipo_documentos="{{ $tipoDocumentos }}" redirect="true" />
                </form>
            </div>
        </div>

    </section>
@endsection
