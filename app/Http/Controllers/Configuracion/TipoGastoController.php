<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoGasto\StoreRequest;
use App\Http\Requests\TipoGasto\UpdateRequest;
use App\Models\TipoGasto;
use Illuminate\Http\Request;

class TipoGastoController extends Controller
{
    public function index()
    {
        return view('admin.tipogasto.index', [
            'tiposGasto' => TipoGasto::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.tipogasto.create', [
            'tipos_gasto' => new TipoGasto()
        ]);
    }

    public function store(StoreRequest $request)
    {
        TipoGasto::create($request->validated());
        return redirect()->route('admin.tipos-gasto.index')->with('flash', 'Tipo de gasto creado corretamente');
    }

    public function edit(TipoGasto $tipos_gasto)
    {
        return view('admin.tipogasto.edit', [
            'tipos_gasto' => $tipos_gasto
        ]);
    }

    public function update(UpdateRequest $request, TipoGasto $tipos_gasto)
    {
        $tipos_gasto->update($request->validated());
        return redirect()->route('admin.tipos-gasto.index')->with('flash', 'Tipo de gasto actualizado corretamente');
    }

    public function destroy(TipoGasto $tipos_gasto)
    {
        $tipos_gasto->delete();
        return redirect()->route('admin.tipos-gasto.index')->with('flash', 'Tipo de gasto eliminado corretamente');
    }
}
