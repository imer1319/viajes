<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Recibo</title>
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
                        <td class="text-gray-500">Cliente:</td>
                        <td class="text-gray-500" style="text-align: right">{{ $recibo->cliente->razon_social }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500">Domicilio:</td>
                        <td class="text-gray-500" style="text-align: right">{{ $recibo->cliente->domicilio }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500">{{ $recibo->cliente->condicionIva->descripcion }}</td>
                    </tr>
                </table>
            </td>
            <td style="width:50%; text-align:center; vertical-align:top; padding-top:10px;">
                <table style="width: 80%; margin: 0 auto;  text-align:center; margin-top:10px">
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <h3 class="text-gray-500">RECIBO</h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-500">Nro.: </td>
                        <td class="text-gray-500" style="text-align:right">
                            {{ str_pad($recibo->numero_interno, 5, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500">Fecha</td>
                        <td class="text-gray-500" style="text-align:right">
                            {{ $recibo->created_at->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500">Cuit:</td>
                        <td class="text-gray-500" style="text-align:right">{{ $recibo->cliente->cuit }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500">Ing. Brutos:</td>
                        <td class="text-gray-500" style="text-align:right">{{ $recibo->cliente->numero_ingreso_bruto }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="relative overflow-x-auto shadow-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-white uppercase bg-blue-400">
                <tr>
                    <td colspan="6" align="center">
                        <p style="margin:0.5rem;">FACTURAS DE CLIENTE</p>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-2">Ord</td>
                    <td class="px-6 py-2">Fecha</td>
                    <td class="px-6 py-2"># Factura</td>
                    <td class="px-6 py-2">Importe</td>
                    <td class="px-6 py-2">Saldo total</td>
                    <td class="px-6 py-2">Pago</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalFactura = 0;
                @endphp

                @foreach ($recibo->facturas as $factura)
                    @php
                        $totalFactura += $factura->pago;
                    @endphp
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-2 py-4">{{ $loop->iteration }}</td>
                        <td class="px-2 py-4">{{ $factura->factura->fecha }}</td>
                        <td class="px-2 py-4">
                            {{ $factura->factura->numero_factura_1 }}-{{ $factura->factura->numero_factura_2 }}</td>
                        <td class="px-2 py-4">{{ number_format($factura->factura->total, 2, ',', '.') }}
                        </td>
                        <td class="px-2 py-4">{{ number_format($factura->factura->saldo_total, 2, ',', '.') }}</td>
                        <td class="px-2 py-4">
                            {{ number_format($factura->pago, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Total</td>
                    <td colspan="4"></td>
                    <td class="px-2 py-2">
                        {{ number_format($totalFactura, 2, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="relative overflow-x-auto shadow-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-white uppercase bg-blue-400">
                <tr>
                    <td colspan="6" align="center">
                        <p style="margin:0.5rem;">FORMAS DE PAGO</p>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-2">Numero</td>
                    <td class="px-6 py-2">Forma</td>
                    <td class="px-6 py-2">Descripcion</td>
                    <td class="px-6 py-2">Fecha emision</td>
                    <td class="px-6 py-2">Fecha vencimiento</td>
                    <td class="px-6 py-2">Importe</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPagos = 0;
                @endphp

                @foreach ($recibo->pagos as $pago)
                    @php
                        $totalPagos += $pago->importe;
                    @endphp
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-2 py-4">{{ $pago->numero }}</td>
                        <td class="px-2 py-4">{{ $pago->abreviacion }}</td>
                        <td class="px-2 py-4">{{ $pago->descripcion }}</td>
                        <td class="px-2 py-4">{{ $pago->fecha_emision }}</td>
                        <td class="px-2 py-4">{{ $pago->fecha_vencimiento }}</td>
                        <td class="px-2 py-4">
                            {{ number_format($pago->importe, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Total</td>
                    <td colspan="4"></td>
                    <td class="px-2 py-2">
                        {{ number_format($totalPagos, 2, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="relative overflow-x-auto shadow-md">
        <table width="100%">
            <tr>
                <td align="right">
                    <span class="text-gray-500">CANCELACION:
                        {{ number_format($recibo->total_recibo, 2, ',', '.') }}</span>
                </td>
            </tr>
        </table>
        <div>
            <span class="text-gray-500"><b>SON: {{ $numero_letra }}</b></span>
            <br>
            <span class="text-gray-500">Observaciones:</span>
            <br>
            <span class="text-gray-500">{{ $recibo->observaciones }}</span>
        </div>
    </div>
</body>

</html>
