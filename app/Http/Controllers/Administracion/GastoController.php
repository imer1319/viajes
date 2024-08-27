<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\GastosExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Gasto\StoreRequest;
use App\Http\Requests\Gasto\UpdateRequest;
use App\Models\Chofer;
use App\Models\GastoChofer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GastoController extends Controller
{
    public function index()
    {
        return view('admin.gastos.index', [
            'gastos' => GastoChofer::with('chofer')->paginate(8)
        ]);
    }

    public function create()
    {
        $ultimoGastoChofer = GastoChofer::latest()->first();
        $numeroInterno = $ultimoGastoChofer ? $ultimoGastoChofer->id + 1 : 1;
        return view('admin.gastos.create', [
            'numero_interno' => $numeroInterno
        ]);
    }

    public function store(StoreRequest $request)
    {
        $gasto = GastoChofer::create($request->validated());
        $chofer = Chofer::find($request->chofer_id);
        $chofer->update([
            'saldo' => $chofer->saldo + $gasto->importe
        ]);
        if ($gasto) {
            return response()->json(['message' => 'Gasto creado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al crear el nuevo gasto'], 500);
    }

    public function show(GastoChofer $gasto)
    {
        return view('admin.gastos.show', [
            'gasto' => $gasto
        ]);
    }

    public function edit(GastoChofer $gasto)
    {
        return view('admin.gastos.edit', [
            'gasto' => $gasto
        ]);
    }

    public function update(UpdateRequest $request, GastoChofer $gasto)
    {
        $valorAnterior = $gasto->importe;

        $respuesta = $gasto->update($request->validated());

        if ($respuesta) {
            $diferencia = $request->importe - $valorAnterior;
            $chofer = $gasto->chofer;
            $chofer->update([
                'saldo' => $chofer->saldo - $diferencia
            ]);
            return response()->json(['message' => 'Gasto actualizado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al actualizar el nuevo gasto'], 500);
    }

    public function destroy(GastoChofer $gasto)
    {
        $chofer = Chofer::find($gasto->chofer_id);
        
        $chofer->update([
            'saldo' => $chofer->saldo - $gasto->importe
        ]);

        $gasto->delete();
        return redirect()->route('admin.gastos.index')->with('flash', 'Gasto eliminado corretamente');
    }

    public function downloadExcel()
    {
        return Excel::download(new GastosExport, 'gastos.xlsx');
    }
}
