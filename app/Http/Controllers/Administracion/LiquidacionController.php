<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Liquidacion\StoreRequest;
use App\Http\Requests\Liquidacion\UpdateRequest;
use App\Models\Liquidacion;
use Illuminate\Http\Request;

class LiquidacionController extends Controller
{
    public function index()
    {
        return view('admin.liquidaciones.index', [
            'liquidaciones' => Liquidacion::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.liquidaciones.create', [
            'liquidacion' => new Liquidacion(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        Liquidacion::create($request->validated());
        return redirect()->route('admin.liquidaciones.index')->with('flash', 'Liquidacion creado corretamente');
    }

    public function show(Liquidacion $liquidacion)
    {
        return view('admin.liquidaciones.show', [
            'liquidacion' => $liquidacion
        ]);
    }

    public function edit(Liquidacion $liquidacion)
    {
        return view('admin.liquidaciones.edit', [
            'liquidacion' => $liquidacion
        ]);
    }

    public function update(UpdateRequest $request,Liquidacion $liquidacion)
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
}
