<?php

namespace App\Http\Controllers\Administracion;

use App\Events\LiquidacionEliminada;
use App\Exports\LiquidacionesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Liquidacion\StoreRequest;
use App\Http\Requests\Liquidacion\UpdateRequest;
use App\Models\Chofer;
use App\Models\Liquidacion;
use App\Traits\NumeroALetra;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LiquidacionController extends Controller
{
    use NumeroALetra;

    public function index()
    {
        return view('admin.liquidaciones.index', [
            'liquidaciones' => Liquidacion::with('chofer')->paginate(8)
        ]);
    }

    public function create()
    {
        $ultimaLiquidacion = Liquidacion::latest()->first();

        return view('admin.liquidaciones.create', [
            'liquidacion' => new Liquidacion(),
            'numero_interno' => $ultimaLiquidacion ? $ultimaLiquidacion->id + 1 : 1,
        ]);
    }

    public function show(Liquidacion $liquidacione)
    {
        return view('admin.liquidaciones.show', [
            'liquidacion' => $liquidacione
        ]);
    }

    public function edit(Liquidacion $liquidacione)
    {
        return view('admin.liquidaciones.edit', [
            'liquidacion' => $liquidacione->load([
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

    public function destroy(Liquidacion $liquidacione)
    {
        try {
            DB::beginTransaction();
            event(new LiquidacionEliminada($liquidacione->chofer_id, $liquidacione->id));
            $liquidacione->delete();
            $chofer = Chofer::find($liquidacione->chofer_id);
            $chofer->update([
                'saldo' => $chofer->saldo - $liquidacione->total_liquidacion
            ]);
            DB::commit();
            return redirect()->route('admin.liquidaciones.index')->with('flash', 'Liquidacion eliminada corretamente');
        } catch (\Exception $e) {
            DB::rollBack();
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

    public function downloadExcel()
    {
        return Excel::download(new LiquidacionesExport, 'liquidaciones.xlsx');
    }
}
