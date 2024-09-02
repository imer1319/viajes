<?php

namespace App\Http\Controllers\Main;

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
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class FacturacionController extends Controller
{
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

    public function show(ClienteFactura $factura)
    {
        return view('admin.facturas.show', [
            'factura' => $factura
        ]);
    }

    public function edit(ClienteFactura $facturae)
    {
        return view('admin.facturas.edit', [
            'factura' => $facturae->load([
                'movimientos.movimiento',
                'movimientos.movimiento.cliente',
                'movimientos.movimiento.tipoViaje',
                'gastos.gasto',
                'gastos.gasto.proveedor',
                'gastos.gasto.chofer',
                'gastos.gasto.flota',
                'anticipos.anticipo',
                'chofer'
            ])
        ]);
    }

    public function destroy(ClienteFactura $facturae)
    {
        try {
            DB::beginTransaction();
            // event(new LiquidacionEliminada($facturae->chofer_id, $facturae->id));
            $facturae->delete();
            // $chofer = Cliente::find($facturae->chofer_id);
            // $chofer->update([
            //     'saldo' => $chofer->saldo + $facturae->total_factura
            // ]);
            DB::commit();
            return redirect()->route('admin.facturas.index')->with('flash', 'ClienteFactura eliminada corretamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Hubo un error al eliminar la liquidación.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function downloadPdf(ClienteFactura $factura)
    {
        $factura->load([
            'movimientos.movimiento',
            'gastos.gasto',
            'anticipos.anticipo',
        ]);
        $numero_letra = $this->convertirNumeroALetras($factura->total_factura);
        $pdf = Pdf::loadView('reportes.factura', compact('factura', 'numero_letra'));
        return $pdf->stream();
    }

    public function downloadExcel()
    {
        return Excel::download(new FacturasExport, 'facturas.xlsx');
    }
}
