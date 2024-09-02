<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Movimiento</title>
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
    <table style="width: 100%">
        <tr>
            <td width="50%" style="vertical-align: top;">
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white uppercase bg-blue-400">
                            <tr>
                                <td colspan="2" align="center">
                                    <p style="margin:0.5rem;">MOVIMIENTOS</p>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400" width="40%">Ord</td>
                                <td align="left" width="60%">{{ $movimiento->id }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Fecha</td>
                                <td align="left">{{ $movimiento->fecha }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Tipo de viaje</td>
                                <td align="left">{{ $movimiento->tipoViaje->descripcion }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400"># Factura</td>
                                <td align="left">{{ $movimiento->numero_factura_1 }}-{{ $movimiento->numero_factura_2 }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Precio real</td>
                                <td align="left">{{ number_format($movimiento->precio_real, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">IVA</td>
                                <td align="left">{{ number_format($movimiento->iva, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Total</td>
                                <td align="left">{{ number_format($movimiento->total, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Precio del chofer</td>
                                <td align="left">{{ number_format($movimiento->precio_chofer, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Porcentaje de pago</td>
                                <td align="left">{{ $movimiento->porcentaje_pago }} %</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Comisión del chofer</td>
                                <td align="left">{{ number_format($movimiento->comision_chofer, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Saldo de la comisión del
                                    chofer</td>
                                <td align="left">{{ number_format($movimiento->saldo_comision_chofer, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
            <td width="50%" style="vertical-align: top;">
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-white uppercase bg-blue-400">
                            <tr>
                                <td colspan="2" align="center">
                                    <p style="margin:0.5rem;">CHOFER</p>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400" width="40%">Nombre
                                </td>
                                <td align="left" width="60%">{{ $movimiento->chofer->nombre }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">DNI</td>
                                <td align="left">{{ $movimiento->chofer->dni }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">CUIL</td>
                                <td align="left">{{ $movimiento->chofer->cuil }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Saldo</td>
                                <td align="left">{{ number_format($movimiento->chofer->saldo, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="relative overflow-x-auto shadow-md mt-4">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-white uppercase bg-blue-400">
                            <tr>
                                <td colspan="2" align="center">
                                    <p style="margin:0.5rem;">CLIENTE</p>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400" width="40%">Razón
                                    Social</td>
                                <td align="left" width="60%">{{ $movimiento->cliente->razon_social }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">CUIT</td>
                                <td align="left">{{ $movimiento->cliente->cuit }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Teléfono</td>
                                <td align="left">{{ $movimiento->cliente->telefono }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Celular</td>
                                <td align="left">{{ $movimiento->cliente->celular }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Saldo</td>
                                <td align="left">{{ number_format($movimiento->cliente->saldo, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="relative overflow-x-auto shadow-md mt-4">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-white uppercase bg-blue-400">
                            <tr>
                                <td colspan="2" align="center">
                                    <p style="margin:0.5rem;">FLOTA</p>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400" width="40%">Nombre
                                </td>
                                <td align="left">{{ $movimiento->flota->nombre }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Placa</td>
                                <td align="left">{{ $movimiento->flota->placa }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-2 text-xs text-white uppercase bg-blue-400">Marca</td>
                                <td align="left">{{ $movimiento->flota->marca }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
