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

        .text-white {
            color: #fff;
        }

        .text-gray-700 {
            color: #374151;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .bg-blue-400 {
            background-color: #007bff;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
            font-size: 13px;
            page-break-inside: auto;
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

        .table tbody {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        table tfoot {
            display: table-row-group;
        }

        tfoot {
            position: fixed;
            bottom: 0;
            background-color: #f8f9fa;
            border-top: 2px solid #dee2e6;
        }

        body {
            margin-top: 1.2cm;
            margin-bottom: 2cm;
            margin-left: 1cm;
            margin-right: 1cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;

            background-color: #007bff;
            color: white;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 1cm;
            right: 1cm;
            height: 1.5cm;
        }

        @page {
            margin: 0cm 0cm;
        }

        @media print {
            tfoot {
                display: table-row-group;
                page-break-before: always;
                bottom: 0;
            }
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        tfoot {
            position: sticky;
            bottom: 0;
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
        <table width="100%" style="border-top: 2px solid #727272;">
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
    <main>
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
                        <td>{{ $movimiento->numero_factura_1 }} - {{ $movimiento->numero_factura_2 }}
                        </td>
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
            <tfoot>
                <tr>
                    <th colspan="5">Totales</th>
                    <th>{{ number_format($totales['total'], 2, ',', '.') }}</th>
                    <th>{{ number_format($totales['saldo_total'], 2, ',', '.') }}</th>
                    <th colspan="2"></th>
                    <th>{{ number_format($totales['comision_chofer'], 2, ',', '.') }}</th>
                    <th>{{ number_format($totales['saldo_comision_chofer'], 2, ',', '.') }}</th>
                    <th colspan="3"></th>
                </tr>
            </tfoot>
        </table>
    </main>
</body>

</html>
