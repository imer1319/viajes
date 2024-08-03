<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoComprobante\StoreRequest;
use App\Http\Requests\TipoComprobante\UpdateRequest;
use App\Models\TipoComprobante;

class TipoComprobanteController extends Controller
{
    public function index()
    {
        return view('admin.tipoComprobantes.index', [
            'tipoComprobantes' => TipoComprobante::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.tipoComprobantes.create', [
            'comprobante' => new TipoComprobante()
        ]);
    }

    public function store(StoreRequest $request)
    {
        TipoComprobante::create($request->validated());
        return redirect()->route('admin.tipo-comprobantes.index')->with('flash', 'Tipo de comprobante creado corretamente');
    }

    public function edit(TipoComprobante $tipoComprobante)
    {
        return view('admin.tipoComprobantes.edit', [
            'comprobante' => $tipoComprobante
        ]);
    }

    public function update(UpdateRequest $request, TipoComprobante $tipoComprobante)
    {
        $tipoComprobante->update($request->validated());
        return redirect()->route('admin.tipo-comprobantes.index')->with('flash', 'Tipo de comprobante actualizado corretamente');
    }

    public function destroy(TipoComprobante $tipoComprobante)
    {
        $tipoComprobante->delete();
        return redirect()->route('admin.tipo-comprobantes.index')->with('flash', 'Tipo de comprobante eliminado corretamente');
    }
}
