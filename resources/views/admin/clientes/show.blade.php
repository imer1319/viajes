@extends('layouts.admin')

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
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Ver cliente</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <strong><i class="fas fa-money-check mr-1"></i> Movimiento</strong>
                        <p class="text-muted">Razon social: {{ $cliente->razon_social }}</p>
                        <p class="text-muted">CUIT: {{ $cliente->cuit }}</p>
                        <p class="text-muted"># de ingreso bruto: {{ $cliente->numero_ingreso_bruto }}</p>
                        <p class="text-muted">Telefono: {{ $cliente->telefono }}</p>
                        <p class="text-muted">Celular: {{ $cliente->celular }}</p>
                        <p class="text-muted">Email: {{ $cliente->email }}</p>
                        <p class="text-muted">Contacto: {{ $cliente->contacto }}</p>
                        <p class="text-muted">Saldo: {{ $cliente->saldo }}</p>
                        <p class="text-muted">Estado: {{ $cliente->estado = 1 ? 'ACTIVO' : 'INACTIVO' }}</p>
                    </div>
                    <div class="col-7">
                        <strong><i class="fas fa-comments-dollar mr-1"></i> Condicion IVA</strong>
                        <p class="text-muted">Codigo: {{ $cliente->condicionIva->codigo }}</p>
                        <p class="text-muted">Descripcion: {{ $cliente->condicionIva->descripcion }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker mr-1"></i> Ubicacion</strong>
                        <p class="text-muted">Domicilio: {{ $cliente->domicilio }}</p>
                        <p class="text-muted">Codigo postal: {{ $cliente->codigo_postal }}</p>
                        <p class="text-muted">Provincia: {{ $cliente->provincia->nombre }}</p>
                        <p class="text-muted">Departamento: {{ $cliente->departamento->nombre }}</p>
                        <p class="text-muted">Localidad: {{ $cliente->localidad->nombre }}</p>
                        <hr>
                        <strong><i class="fas fa-chart-area mr-1"></i> Retencion de ganancia</strong>
                        <p class="text-muted">Codigo: {{ $cliente->retencionGanancia->codigo }}</p>
                        <p class="text-muted">Tipo: {{ $cliente->retencionGanancia->tipo }}</p>
                        <hr>
                        <strong><i class="fas fa-keyboard mr-1"></i> Retencion de ingreso bruto</strong>
                        <p class="text-muted">Descripcion: {{ $cliente->retencionIngresoBruto->descripcion }}</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
