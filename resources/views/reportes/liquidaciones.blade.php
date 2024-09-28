<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Liquidaciones</title>
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
            padding: 10px 3px;
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
                    <span>Listado de liquidaciones</span>
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
                    <th style="padding: 0.2rem">Chofer</th>
                    <th style="padding: 0.2rem">Tipo gastos</th>
                    <th style="padding: 0.2rem">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($liquidaciones as $liquidacion)
                    <tr>
                        <td>{{ $liquidacion->numero_interno }}</td>
                        <td>{{ $liquidacion->fecha }}</td>
                        <td>{{ $liquidacion->chofer->nombre }}</td>
                        <td>
                            @foreach ($liquidacion->pagos as $pago)
                                <span class="badge badge-primary">{{ $pago->forma->descripcion }}</span> <br>
                            @endforeach
                        </td>
                        <td>{{ number_format($liquidacion->total_liquidacion, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" align="left">Totales</td>
                    <td>{{ number_format($totales['total_liquidacion'], 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </main>
</body>

</html>
