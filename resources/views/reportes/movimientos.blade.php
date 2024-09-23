<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Movimientos</title>
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

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .thead-light th {
            background-color: #f8f9fa;
            color: #495057;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #007bff;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>

<body>
    <header>
        <table width="100%">
            <tr>
                <td align="center" style="width: 100%; font-size:16px; padding-top:7px">
                    <span>Listado de movimientos</span>
                </td>
            </tr>
        </table>
    </header>
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
    <table>
        <tr>
            <td width="100%" style="vertical-align: top;">
                <div class="relative overflow-x-auto shadow-md">
                    <table class="table table-bordered">
                        <thead class="text-xs text-white uppercase bg-blue-400">
                            <tr>
                                <th style="padding: 0.2rem">Int</th>
                                <th style="padding: 0.2rem">Fecha</th>
                                <th style="padding: 0.2rem">Cliente</th>
                                <th style="padding: 0.2rem">Tipo viaje</th>
                                <th style="padding: 0.2rem"># Remito</th>
                                <th style="padding: 0.2rem">Total</th>
                                <th style="padding: 0.2rem">Saldo</th>
                                <th style="padding: 0.2rem">Flota</th>
                                <th style="padding: 0.2rem">Chofer</th>
                                <th style="padding: 0.2rem">Comision chofer</th>
                                <th style="padding: 0.2rem">Saldo comision chofer</th>
                                <th style="padding: 0.2rem">Fact</th>
                                <th style="padding: 0.2rem"># Factura</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movimientos as $movimiento)
                                <tr>
                                    <td>{{ $movimiento->numero_interno }}</td>
                                    <td>{{ $movimiento->fecha }}</td>
                                    <td>{{ $movimiento->cliente->razon_social }}</td>
                                    <td>{{ $movimiento->tipoViaje->descripcion }}</td>
                                    <td>{{ $movimiento->numero_factura_1 }} - {{ $movimiento->numero_factura_2 }}</td>
                                    <td>{{ number_format($movimiento->total, 2, ',', '.') }}</td>
                                    <td>{{ number_format($movimiento->saldo_total, 2, ',', '.') }}</td>
                                    <td>{{ $movimiento->flota->nombre }}</td>
                                    <td>{{ $movimiento->chofer->nombre }}</td>
                                    <td>{{ number_format($movimiento->comision_chofer, 2, ',', '.') }}</td>
                                    <td>{{ number_format($movimiento->saldo_comision_chofer, 2, ',', '.') }}</td>
                                    <td>{{ $movimiento->facturado == 1 ? 'Si' : 'No' }}</td>
                                    <td>
                                        @if ($movimiento->facturas->isNotEmpty())
                                            @foreach ($movimiento->facturas as $factura)
                                                {{ $factura->numero_factura_1 }}-{{ $factura->numero_factura_2 }}
                                            @endforeach
                                        @else
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
