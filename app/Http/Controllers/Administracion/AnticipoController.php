<?php

namespace App\Http\Controllers\Administracion;

use App\Events\AnticipoCreado;
use App\Events\AnticipoEliminado;
use App\Exports\AnticiposExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Anticipo\StoreRequest;
use App\Http\Requests\Anticipo\UpdateRequest;
use App\Models\AnticipoChofer;
use App\Models\Chofer;
use Maatwebsite\Excel\Facades\Excel;

class AnticipoController extends Controller
{
    public function index()
    {
        return view('admin.anticipos.index', [
            'anticipos' => AnticipoChofer::with('chofer')->paginate(8)
        ]);
    }

    public function create()
    {
        $ultimoAnticipoChofer = AnticipoChofer::latest()->first();
        $numeroInterno = $ultimoAnticipoChofer ? $ultimoAnticipoChofer->id + 1 : 1;
        return view('admin.anticipos.create', [
            'numero_interno' => $numeroInterno
        ]);
    }

    public function store(StoreRequest $request)
    {
        $anticipo = AnticipoChofer::create($request->validated());
        $chofer = Chofer::find($request->chofer_id);
        $chofer->update([
            'saldo' => $chofer->saldo - $anticipo->importe
        ]);

        if ($anticipo) {
            return response()->json(['message' => 'Anticipo creado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al crear el nuevo anticipo'], 500);
    }

    public function show(AnticipoChofer $anticipo)
    {
        return view('admin.anticipos.show', [
            'anticipo' => $anticipo
        ]);
    }

    public function edit(AnticipoChofer $anticipo)
    {
        return view('admin.anticipos.edit', [
            'anticipo' => $anticipo
        ]);
    }

    public function update(UpdateRequest $request, AnticipoChofer $anticipo)
    {
        $valorAnterior = $anticipo->importe;
        $respuesta = $anticipo->update($request->validated());

        if ($respuesta) {
            $diferencia = $request->importe - $valorAnterior;
            $chofer = $anticipo->chofer;
            $chofer->update([
                'saldo' => $chofer->saldo - $diferencia
            ]);
            return response()->json(['message' => 'Anticipo actualizado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al actualizar el anticipo'], 500);
    }

    public function destroy(AnticipoChofer $anticipo)
    {
        $chofer = $anticipo->chofer;
        
        $chofer->update([
            'saldo' => $chofer->saldo + $anticipo->importe
        ]);
        
        $anticipo->delete();

        return redirect()->route('admin.anticipos.index')->with('flash', 'Anticipo eliminado corretamente');
    }

    public function downloadExcel()
    {
        return Excel::download(new AnticiposExport, 'anticipos.xlsx');
    }
}
