<?php

namespace App\Http\Controllers\Main;

use App\Events\FacturaEliminada;
use App\Exports\FacturasExport;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\ClienteFactura;
use App\Models\CondicionesPago;
use App\Models\CondicionIva;
use App\Models\Provincia;
use App\Models\RetencionGanancia;
use App\Models\RetencionIngresosBruto;
use App\Models\TipoDocumento;
use App\Traits\NumeroALetra;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacturacionController extends Controller
{
    use NumeroALetra;

    public function index()
    {
        $facturas = ClienteFactura::with('cliente')->paginate(8);

        $totales = [
            'neto' => $facturas->sum('neto'),
            'iva' => $facturas->sum('iva'),
            'total' => $facturas->sum('total'),
            'saldo_total' => $facturas->sum('saldo_total'),
        ];
        return view('admin.facturas.index', [
            'facturas' => $facturas,
            'clientes' => Cliente::all(),
            'totales' => $totales,
        ]);
    }

    public function search(Request $request)
    {
        $facturas = ClienteFactura::query()
            ->byClienteId($request->input('cliente_id'))
            ->bySaldo($request->input('saldo'))
            ->byDesde($request->input('desde'))
            ->byHasta($request->input('hasta'))
            ->with('cliente')
            ->latest()
            ->paginate(8);

        $facturas->appends($request->except('page'));

        $totales = [
            'neto' => $facturas->sum('neto'),
            'iva' => $facturas->sum('iva'),
            'total' => $facturas->sum('total'),
            'saldo_total' => $facturas->sum('saldo_total'),
        ];

        return view('admin.facturas.index', [
            'facturas' => $facturas,
            'totales' => $totales,
            'clientes' => Cliente::all()
        ]);
    }

    public function create()
    {
        $ultimaLiquidacion = ClienteFactura::latest()->first();
        $ultimaFactura = ClienteFactura::latest()->first();

        $sugerenciaNumeroFactura1 = '0001';
        $sugerenciaNumeroFactura2 = '00000001';
        if ($ultimaFactura) {
            $ultimoNumeroFactura1 = str_pad($ultimaFactura->numero_factura_1, 4, '0', STR_PAD_LEFT);
            $ultimoNumeroFactura2 = str_pad($ultimaFactura->numero_factura_2, 8, '0', STR_PAD_LEFT);
            $numero1 = (int) $ultimoNumeroFactura1;
            $numero2 = (int) $ultimoNumeroFactura2;
            $numero2++;
            if ($numero2 > 99999999) {
                $numero2 = 1;
                $numero1++;
            }
            $sugerenciaNumeroFactura1 = str_pad($numero1, 4, '0', STR_PAD_LEFT);
            $sugerenciaNumeroFactura2 = str_pad($numero2, 8, '0', STR_PAD_LEFT);
        }

        return view('admin.facturas.create', [
            'numero_interno' => $ultimaLiquidacion ? $ultimaLiquidacion->id + 1 : 1,
            'clientes' => Cliente::all(),
            'condicionesPago' => CondicionesPago::all(),
            'condicionesIva' => CondicionIva::all(),
            'provincias' => Provincia::all(),
            'retencionGanancias' => RetencionGanancia::all(),
            'retencionIngresosBruto' => RetencionIngresosBruto::all(),
            'tipoDocumentos' => TipoDocumento::all(),
            'sugerenciaNumeroFactura1' => $sugerenciaNumeroFactura1,
            'sugerenciaNumeroFactura2' => $sugerenciaNumeroFactura2,
        ]);
    }

    public function show(ClienteFactura $facturacione)
    {
        return view('admin.facturas.show', [
            'factura' => $facturacione->load('cliente', 'detalles')
        ]);
    }

    public function edit(ClienteFactura $facturacione)
    {
        return view('admin.facturas.edit', [
            'factura' => $facturacione->load('cliente'),
            'clientes' => Cliente::all(),
            'condicionesPago' => CondicionesPago::all(),
            'condicionesIva' => CondicionIva::all(),
            'provincias' => Provincia::all(),
            'retencionGanancias' => RetencionGanancia::all(),
            'retencionIngresosBruto' => RetencionIngresosBruto::all(),
            'tipoDocumentos' => TipoDocumento::all(),
        ]);
    }

    public function destroy(ClienteFactura $facturacione)
    {
        try {
            DB::beginTransaction();
            $movimientos = $facturacione->detalles->map(function ($detalle) {
                return $detalle->movimiento;
            })->all();
            event(new FacturaEliminada($facturacione, $movimientos));
            $facturacione->delete();
            DB::commit();
            return redirect()->route('admin.facturaciones.index')->with('success', 'Factura eliminada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar la factura:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'factura_id' => $facturacione->id, // Si quieres guardar más detalles, como el ID de la factura
            ]);
            return redirect()->route('admin.facturaciones.index')->with('error', 'Hubo un error al eliminar la factura.');
        }
    }

    public function downloadPdf(ClienteFactura $factura)
    {
        $factura->load([
            'detalles.movimiento',
        ]);
        $numero_letra = $this->convertirNumeroALetras($factura->total);
        $pdf = Pdf::loadView('reportes.factura', compact('factura', 'numero_letra'));
        return $pdf->stream();
    }

    public function downloadExcel(Request $request)
    {
        return Excel::download(new FacturasExport($request->all()), 'facturas.xlsx');
    }

    public function print(Request $request)
    {
        $facturas = ClienteFactura::query()
            ->byClienteId($request->input('cliente_id'))
            ->bySaldo($request->input('saldo'))
            ->byDesde($request->input('desde'))
            ->byHasta($request->input('hasta'))
            ->with('cliente')
            ->get();

        $totales = [
            'neto' => $facturas->sum('neto'),
            'iva' => $facturas->sum('iva'),
            'total' => $facturas->sum('total'),
            'saldo_total' => $facturas->sum('saldo_total'),
        ];

        $pdf = Pdf::loadView('reportes.facturas', compact('facturas', 'totales'));

        $pdf->setPaper('A4', 'landscape');

        $pdf->set_option('isHtml5ParserEnabled', true);

        return $pdf->stream();
    }
}
