@extends('layouts.admin')

@section('title','Proveedores')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Proveedores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.proveedores.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Vista proveedor</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <strong><i class="fas fa-user mr-1"></i> Proveedor</strong>
                        <p class="text-muted">Razon social: {{ $proveedor->razon_social }}</p>
                        <p class="text-muted">CUIT: {{ $proveedor->cuit }}</p>
                        <p class="text-muted"># de ingreso bruto: {{ $proveedor->numero_ingreso_bruto }}</p>
                        <p class="text-muted">Plan de cuenta: {{ $proveedor->planCuenta->descripcion }}</p>
                        <p class="text-muted">Telefono: {{ $proveedor->telefono }}</p>
                        <p class="text-muted">Celular: {{ $proveedor->celular }}</p>
                        <p class="text-muted">Email: {{ $proveedor->email }}</p>
                        <p class="text-muted">Contacto: {{ $proveedor->contacto }}</p>
                        <p class="text-muted">Saldo: {{ $proveedor->saldo }}</p>
                        <p class="text-muted">Estado: {{ $proveedor->estado = 1 ? 'ACTIVO' : 'INACTIVO' }}</p>
                    </div>
                    <div class="col-7">
                        <strong><i class="fas fa-comments-dollar mr-1"></i> Condicion IVA</strong>
                        <p class="text-muted">Codigo: {{ $proveedor->condicionIva->codigo }}</p>
                        <p class="text-muted">Descripcion: {{ $proveedor->condicionIva->descripcion }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker mr-1"></i> Ubicacion</strong>
                        <p class="text-muted">Domicilio: {{ $proveedor->domicilio }}</p>
                        <p class="text-muted">Codigo postal: {{ $proveedor->codigo_postal }}</p>
                        <p class="text-muted">Provincia: {{ $proveedor->provincia->nombre }}</p>
                        <p class="text-muted">Departamento: {{ $proveedor->departamento->nombre }}</p>
                        <p class="text-muted">Localidad: {{ $proveedor->localidad->nombre }}</p>
                        <hr>
                        <strong><i class="fas fa-chart-area mr-1"></i> Retencion de ganancia</strong>
                        <p class="text-muted">Codigo: {{ $proveedor->retencionGanancia->codigo }}</p>
                        <p class="text-muted">Tipo: {{ $proveedor->retencionGanancia->tipo }}</p>
                        <hr>
                        <strong><i class="fas fa-keyboard mr-1"></i> Retencion de ingreso bruto</strong>
                        <p class="text-muted">Descripcion: {{ $proveedor->retencionIngresoBruto->descripcion }}</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
