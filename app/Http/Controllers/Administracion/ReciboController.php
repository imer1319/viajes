<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\ReciboExport;
use App\Models\Recibo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
            'numero_interno' => $ultimaRecibo ? $ultimaRecibo->id + 1 : 1,
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

    public function destroy(Recibo $recibo)
    {
        try {
            DB::beginTransaction();
            // event(new ReciboEliminada($recibo->chofer_id, $recibo->id));
            // $recibo->delete();
            // $chofer = Chofer::find($recibo->chofer_id);
            // $chofer->update([
            //     'saldo' => $chofer->saldo + $recibo->total_liquidacion
            // ]);
            DB::commit();
            return redirect()->route('admin.recibos.index')->with('flash', 'Recibo eliminada corretamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Hubo un error al eliminar la liquidación.',
                'error' => $e->getMessage(),
            ], 500);
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