<?php

namespace App\Http\Controllers\Administracion;

use App\Events\LiquidacionEliminada;
use App\Exports\LiquidacionesExport;
use App\Http\Controllers\Controller;
use App\Models\Banco;
use App\Models\Chofer;
use App\Models\FormasPagos;
use App\Models\Liquidacion;
use App\Traits\NumeroALetra;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class LiquidacionController extends Controller
{
    use NumeroALetra;

    public function index()
    {
        $liquidaciones = Liquidacion::with('chofer')->paginate(8);

        $totales = [
            'total_liquidacion' => $liquidaciones->sum('total_liquidacion'),
        ];
        return view('admin.liquidaciones.index', [
            'liquidaciones' => $liquidaciones,
            'formas' => FormasPagos::all(),
            'choferes' => Chofer::all(),
            'totales' => $totales,
        ]);
    }

    public function search(Request $request)
    {
        $liquidaciones = Liquidacion::query()
            ->byFormaPagoId($request->input('forma_id'))
            ->byChoferId($request->input('chofer_id'))
            ->byDesde($request->input('desde'))
            ->byHasta($request->input('hasta'))
            ->with('chofer')
            ->latest()
            ->paginate(8);

        $liquidaciones->appends($request->except('page'));

        $totales = [
            'total_liquidacion' => $liquidaciones->sum('total_liquidacion'),
        ];

        return view('admin.liquidaciones.index', [
            'liquidaciones' => $liquidaciones,
            'choferes' => Chofer::all(),
            'formas' => FormasPagos::all(),
            'totales' => $totales,
        ]);
    }
    
    public function create()
    {
        $ultimaLiquidacion = Liquidacion::latest()->first();

        return view('admin.liquidaciones.create', [
            'choferes' => Chofer::all(),
            'liquidacion' => new Liquidacion(),
            'numero_interno' => $ultimaLiquidacion ? $ultimaLiquidacion->numero_interno + 1 : 1,
            'formaPagos' => FormasPagos::all(),
            'bancos' => Banco::all(),
        ]);
    }

    public function show(Liquidacion $liquidacione)
    {
        return view('admin.liquidaciones.show', [
            'liquidacion' => $liquidacione->load('movimientos', 'gastos', 'anticipos', 'pagos'),
            'numero_letra' => $this->convertirNumeroALetras($liquidacione->total_liquidacion)
        ]);
    }

    public function edit(Liquidacion $liquidacione)
    {
        return view('admin.liquidaciones.edit', [
            'liquidacion' => $liquidacione,
            'choferes' => Chofer::all(),
            'formaPagos' => FormasPagos::all(),
            'bancos' => Banco::all(),
        ]);
    }

    public function destroy(Liquidacion $liquidacione)
    {
        try {
            DB::beginTransaction();
            event(new LiquidacionEliminada($liquidacione));
            $liquidacione->delete();

            DB::commit();
            return redirect()->route('admin.liquidaciones.index')->with('flash', 'Liquidacion eliminada corretamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar la liquidacion:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'message' => 'Hubo un error al eliminar la liquidación.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function downloadPdf(Liquidacion $liquidacion)
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

    public function downloadExcel(Request $request)
    {
        return Excel::download(new LiquidacionesExport($request->all()), 'liquidaciones.xlsx');
    }
}
