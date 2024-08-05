<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\CondicionIva\StoreRequest;
use App\Http\Requests\CondicionIva\UpdateRequest;
use App\Models\CondicionIva;
use Illuminate\Http\Request;

class CondicionIvaController extends Controller
{
    public function index()
    {
        return view('admin.condicionesIva.index', [
            'condicionesIva' => CondicionIva::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.condicionesIva.create', [
            'condicion' => new CondicionIva()
        ]);
    }

    public function store(StoreRequest $request)
    {
        CondicionIva::create($request->validated());
        return redirect()->route('admin.condicion-pagos.index')->with('flash', 'Condicion IVA creado corretamente');
    }

    public function edit(CondicionIva $condiciones_iva)
    {
        return view('admin.condicionesIva.edit', [
            'condicion' => $condiciones_iva
        ]);
    }

    public function update(UpdateRequest $request, CondicionIva $condiciones_iva)
    {
        $condiciones_iva->update($request->validated());
        return redirect()->route('admin.condicion-pagos.index')->with('flash', 'Condicion IVA actualizado corretamente');
    }

    public function destroy(CondicionIva $condiciones_iva)
    {
        $condiciones_iva->delete();
        return redirect()->route('admin.condicion-pagos.index')->with('flash', 'Condicion IVA eliminado corretamente');
    }
}
