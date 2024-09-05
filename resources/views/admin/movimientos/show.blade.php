@extends('layouts.admin')

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
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Ver movimiento</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <strong><i class="fas fa-money-check mr-1"></i> Movimiento</strong>
                        <p class="text-muted"><strong>Facturado:</strong>
                            {{ $movimiento->facturado = 1 ? 'Si' : 'No' }}</p>
                        <p class="text-muted"><strong>Numero interno:</strong> {{ $movimiento->numero_interno }}</p>
                        <p class="text-muted">Fecha: {{ $movimiento->fecha }}</p>
                        <p class="text-muted">Tipo de viaje: {{ $movimiento->tipoViaje->descripcion }}</p>
                        <p class="text-muted"># Remito:
                            {{ $movimiento->numero_factura_1 }}-{{ $movimiento->numero_factura_2 }}</p>
                        <p class="text-muted">Precio real: {{ number_format($movimiento->precio_real, 2, ',', '.') }}</p>
                        <p class="text-muted">IVA: {{ number_format($movimiento->iva, 2, ',', '.') }}</p>
                        <p class="text-muted">Total: {{ number_format($movimiento->total, 2, ',', '.') }}</p>
                        <p class="text-muted">Saldo total: {{ number_format($movimiento->saldo_total, 2, ',', '.') }}</p>
                        <p class="text-muted">Precio del chofer:
                            {{ number_format($movimiento->precio_chofer, 2, ',', '.') }}</p>
                        <p class="text-muted">Porcentaje de pago:
                            {{ number_format($movimiento->porcentaje_pago, 2, ',', '.') }} %</p>
                        <p class="text-muted">Comision del chofeer:
                            {{ number_format($movimiento->comision_chofer, 2, ',', '.') }}</p>
                        <p class="text-muted">Saldo de la comision del chofeer:
                            {{ number_format($movimiento->saldo_comision_chofer, 2, ',', '.') }}</p>

                    </div>
                    <div class="col-7">
                        <strong><i class="fas fa-user mr-1"></i> Chofer</strong>
                        <p class="text-muted">Nombre: {{ $movimiento->chofer->nombre }}</p>
                        <p class="text-muted">DNI: {{ $movimiento->chofer->dni }}</p>
                        <p class="text-muted">CUIL: {{ $movimiento->chofer->cuil }}</p>
                        <p class="text-muted">Saldo: {{ number_format($movimiento->chofer->saldo, 2, ',', '.') }}</p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Cliente</strong>
                        <p class="text-muted">Razon social: {{ $movimiento->cliente->razon_social }}</p>
                        <p class="text-muted">CUIT: {{ $movimiento->cliente->cuit }}</p>
                        <p class="text-muted">Telefono: {{ $movimiento->cliente->telefono }}</p>
                        <p class="text-muted">Celular: {{ $movimiento->cliente->celular }}</p>
                        <p class="text-muted">Saldo: {{ number_format($movimiento->cliente->saldo, 2, ',', '.') }}</p>
                        <hr>
                        <strong><i class="fas fa-bus mr-1"></i> Flota</strong>
                        <p class="text-muted">Nombre: {{ $movimiento->flota->nombre }}</p>
                        <p class="text-muted">Placa: {{ $movimiento->flota->placa }}</p>
                        <p class="text-muted">Marca: {{ $movimiento->flota->marca }}</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
