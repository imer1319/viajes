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
use App\Traits\NumeroALetra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReciboController extends Controller
{
    use NumeroALetra;

    public function index()
    {
        return view('admin.recibos.index', [
            'recibos' => Recibo::with('cliente','pagos','pagos.banco')->paginate(8),
            'clientes' => Cliente::all(),
            'formas' => FormasPagos::all(),
        ]);
    }

    public function search(Request $request)
    {
        $recibos = Recibo::query()
            ->byFormaPagoId($request->input('forma_id'))
            ->byClienteId($request->input('cliente_id'))
            ->byDesde($request->input('desde'))
            ->byHasta($request->input('hasta'))
            ->latest()
            ->paginate(8);

        $recibos->appends($request->except('page'));
        return view('admin.recibos.index', [
            'recibos' => $recibos,
            'clientes' => Cliente::all(),
            'formas' => FormasPagos::all(),
        ]);
    }
    public function create()
    {
        $ultimaRecibo = Recibo::latest()->first();

        return view('admin.recibos.create', [
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
            'recibo' => $recibo
        ]);
    }

    public function edit(Recibo $recibo)
    {
        return view('admin.recibos.edit', [
            'recibo' => $recibo,
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

    public function downloadPdf(Recibo $recibo)
    {
        $recibo->load([
            'cliente'
        ]);
        $numero_letra = $this->convertirNumeroALetras($recibo->total_recibo);
        $pdf = Pdf::loadView('reportes.recibo', compact('recibo', 'numero_letra'));
        return $pdf->stream();
    }

    public function downloadExcel(Request $request)
    {
        return Excel::download(new ReciboExport($request->all()), 'recibos.xlsx');
    }
}
