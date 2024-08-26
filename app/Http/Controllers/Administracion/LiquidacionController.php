<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\LiquidacionesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Liquidacion\StoreRequest;
use App\Http\Requests\Liquidacion\UpdateRequest;
use App\Models\Liquidacion;
use App\Traits\NumeroALetra;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function show(Liquidacion $liquidacion)
    {
        return view('admin.liquidaciones.show', [
            'liquidacion' => $liquidacion
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

    public function update(UpdateRequest $request, Liquidacion $liquidacion)
    {
        $res = $liquidacion->update($request->validated());

        if ($res) {
            return response()->json(['message' => 'Liquidacion actualizado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al actualizar la liquidacion'], 500);
    }

    public function destroy(Liquidacion $liquidacion)
    {
        $liquidacion->delete();
        return redirect()->route('admin.liquidaciones.index')->with('flash', 'Liquidacion eliminado corretamente');
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
