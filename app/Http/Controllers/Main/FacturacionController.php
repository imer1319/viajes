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

class FacturacionController extends Controller
{
    use NumeroALetra;

    public function index()
    {
        return view('admin.facturas.index', [
            'facturas' => ClienteFactura::with('cliente')->paginate(8)
        ]);
    }

    public function create()
    {
        $ultimaLiquidacion = ClienteFactura::latest()->first();

        return view('admin.facturas.create', [
            'numero_interno' => $ultimaLiquidacion ? $ultimaLiquidacion->id + 1 : 1,
            'clientes' => Cliente::all(),
            'condicionesPago' => CondicionesPago::all(),
            'condicionesIva' => CondicionIva::all(),
            'provincias' => Provincia::all(),
            'retencionGanancias' => RetencionGanancia::all(),
            'retencionIngresosBruto' => RetencionIngresosBruto::all(),
            'tipoDocumentos' => TipoDocumento::all(),
        ]);
    }

    public function show(ClienteFactura $facturacione)
    {
        return view('admin.facturas.show', [
            'factura' => $facturacione->load('cliente', 'detalles')
        ]);
    }

    public function edit(ClienteFactura $facturae)
    {
        return view('admin.facturas.edit', [
            'factura' => $facturae->load([
                'movimientos.movimiento',
                'movimientos.movimiento.cliente',
                'movimientos.movimiento.tipoViaje',
                'cliente'
            ])
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

    public function downloadExcel()
    {
        return Excel::download(new FacturasExport, 'facturas.xlsx');
    }
}
