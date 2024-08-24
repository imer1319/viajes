<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Liquidacion</title>
    <style>
        body {
            font-family: sans-serif
        }

        tbody,
        tfoot,
        thead {
            text-align: center !important;
        }

        .relative {
            position: relative;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        .shadow-md {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Table settings */
        .w-full {
            width: 100%;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        /* Header settings */
        .text-xs {
            font-size: 0.75rem;
        }

        .text-white {
            color: #fff;
        }

        .text-gray-700 {
            color: #374151;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .bg-gray-50 {
            background-color: #f9fafb;
        }

        .bg-blue-400 {
            background-color: #007bff;
        }

        /* Row and cell settings */
        .border-b {
            border-bottom-width: 1px;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .px-2 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-gray-900 {
            color: #111827;
        }

        .whitespace-nowrap {
            white-space: nowrap;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-blue-600 {
            color: #007bff;
        }

        .hover\:underline:hover {
            text-decoration: underline;
        }

        footer {
            position: fixed;
            bottom: 1cm;
            left: 0px;
            right: 0px;
            height: 10px;
        }
    </style>
</head>

<body>
    <footer>
        <table width="100%" style="border-top: 2px solid #000;">
            <tr style="vertical-align:bottom">
                <td align="left" style="width: 50%;  vertical-align:bottom; font-size:13px;">
                    <span class="text-gray-500">Usuario: {{ auth()->user()->name }}</span>
                </td>
                <td align="right" style="width: 50%;  vertical-align:bottom; font-size:13px;">
                    <span class="text-gray-500">Fecha de impresion: {{ date('d/m/Y') }}</span>
                </td>
            </tr>
        </table>

    </footer>
    <table width="100%">
        <tr>
            <td style="width:50%; text-align:center; vertical-align: top;">
                <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('/img/icono.jpg'))) }}"
                    style="height: 100px;" alt="Company logo">
                <table style="width: 90%; margin: 0 auto;  text-align:center; margin-top:10px">
                    <tr>
                        <td class="text-gray-500">Chofer:</td>
                        <td class="text-gray-500" style="text-align: right">{{ $movimiento->chofer->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500">Domicilio:</td>
                        <td class="text-gray-500" style="text-align: right">{{ $movimiento->chofer->domicilio }}</td>
                    </tr>
                </table>
            </td>
            <td style="width:50%; text-align:center; vertical-align:top; padding-top:10px;">
                <table style="width: 80%; margin: 0 auto;  text-align:center; margin-top:10px">
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <h3 class="text-gray-500">MOVIMIENTO</h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-500">Nro.: </td>
                        <td class="text-gray-500" style="text-align:right">
                            {{ str_pad($movimiento->id, 5, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500">Fecha</td>
                        <td class="text-gray-500" style="text-align:right">
                            {{ $movimiento->created_at->format('d/m/Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div style="width: 100%">
        <div style="width: 50%">
            <div class="relative overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-white uppercase bg-blue-400">
                        <tr>
                            <td colspan="6" align="center">
                                <p style="margin:0.5rem;">MOVIMIENTOS</p>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400" width="50%">Ord</td>
                            <td width="50%">{{ $movimiento->id }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Fecha</td>
                            <td>{{ $movimiento->fecha }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Tipo de viaje</td>
                            <td>{{ $movimiento->tipoViaje->descripcion }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400"># Factura</td>
                            <td>{{ $movimiento->numero_factura_1 }}-{{ $movimiento->numero_factura_2 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="width: 50%">

        </div>
    </div>
    
    <p class="text-muted">Precio real: {{ $movimiento->precio_real }}</p>
    <p class="text-muted">IVA: {{ $movimiento->iva }}</p>
    <p class="text-muted">Total: {{ $movimiento->total }}</p>
    <p class="text-muted">Precio del chofer: {{ $movimiento->precio_chofer }}</p>
    <p class="text-muted">Porcentaje de pago: {{ $movimiento->porcentaje_pago }}</p>
    <p class="text-muted">Comision del chofeer: {{ $movimiento->comision_chofer }}</p>
    <p class="text-muted">Saldo de la comision del chofeer: {{ $movimiento->saldo_comision_chofer }}</p>
    <strong><i class="fas fa-user mr-1"></i> Chofer</strong>
    <p class="text-muted">Nombre: {{ $movimiento->chofer->nombre }}</p>
    <p class="text-muted">Nombre: {{ $movimiento->chofer->nombre }}</p>
    <p class="text-muted">DNI: {{ $movimiento->chofer->dni }}</p>
    <p class="text-muted">CUIL: {{ $movimiento->chofer->cuil }}</p>
    <p class="text-muted">Saldo: {{ $movimiento->chofer->saldo }}</p>
    <hr>
    <strong><i class="fas fa-user mr-1"></i> Cliente</strong>
    <p class="text-muted">Razon social: {{ $movimiento->cliente->razon_social }}</p>
    <p class="text-muted">CUIT: {{ $movimiento->cliente->cuit }}</p>
    <p class="text-muted">Telefono: {{ $movimiento->cliente->telefono }}</p>
    <p class="text-muted">Celular: {{ $movimiento->cliente->celular }}</p>
    <p class="text-muted">Saldo: {{ $movimiento->cliente->saldo }}</p>
    <hr>
    <strong><i class="fas fa-bus mr-1"></i> Flota</strong>
    <p class="text-muted">Nombre: {{ $movimiento->flota->nombre }}</p>
    <p class="text-muted">Placa: {{ $movimiento->flota->placa }}</p>
    <p class="text-muted">Marca: {{ $movimiento->flota->marca }}</p>

</body>

</html>
