<?php

namespace App\Http\Controllers\Administracion;

use App\Events\ReciboEliminado;
use App\Exports\ReciboExport;
use App\Models\Recibo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Banco;
use App\Models\Cliente;
use App\Models\CondicionesPago;
use App\Models\CondicionIva;
use App\Models\FormasPagos;
use App\Models\Provincia;
use App\Models\RetencionGanancia;
use App\Models\RetencionIngresosBruto;
use App\Models\TipoDocumento;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReciboController extends Controller
{
    public function index()
    {
        return view('admin.recibos.index', [
            'recibos' => Recibo::with('cliente')->paginate(8)
        ]);
    }

    public function create()
    {
        $ultimaRecibo = Recibo::latest()->first();

        return view('admin.recibos.create', [
            'liquidacion' => new Recibo(),
            'numero_interno' => $ultimaRecibo ? $ultimaRecibo->numero_interno + 1 : 1,
            'clientes' => Cliente::all(),
            'condicionesIva' => CondicionIva::all(),
            'provincias' => Provincia::all(),
            'retencionGanancias' => RetencionGanancia::all(),
            'retencionIngresosBruto' => RetencionIngresosBruto::all(),
            'tipoDocumentos' => TipoDocumento::all(),
            'formaPagos' => FormasPagos::all(),
            'bancos' => Banco::all(),
        ]);
    }

    public function show(Recibo $recibo)
    {
        return view('admin.recibos.show', [
            'liquidacion' => $recibo
        ]);
    }

    public function edit(Recibo $recibo)
    {
        return view('admin.recibos.edit', [
            'liquidacion' => $recibo->load([
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

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $recibo = Recibo::findOrFail($id);

            event(new ReciboEliminado($recibo));

            $recibo->delete();

            DB::commit();
            return redirect()->route('admin.recibos.index')->with('success', 'Recibo eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar el recibo:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('admin.recibos.index')->with('error', 'Error al eliminar el recibo. Intente nuevamente.');
        }
    }

    public function downloadPdf(Recibo $liquidacion)
    {
        $liquidacion->load([
            'movimientos.movimiento',
            'gastos.gasto',
            'anticipos.anticipo',
            'chofer'
        ]);
        $numero_letra = $this->convertirNumeroALetras($liquidacion->total_liquidacion);
        $pdf = Pdf::loadView('reportes.liquidacion', compact('liquidacion', 'numero_letra'));
        return $pdf->stream();
    }

    public function downloadExcel()
    {
        return Excel::download(new ReciboExport, 'recibos.xlsx');
    }
}
