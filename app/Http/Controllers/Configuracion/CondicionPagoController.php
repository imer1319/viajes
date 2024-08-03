<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\CondicionesPago\StoreRequest;
use App\Http\Requests\CondicionesPago\UpdateRequest;
use App\Models\CondicionesPago;
use Illuminate\Http\Request;

class CondicionPagoController extends Controller
{
    public function index()
    {
        return view('admin.condicionesPago.index', [
            'condicionesPago' => CondicionesPago::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.condicionesPago.create', [
            'condicion' => new CondicionesPago()
        ]);
    }

    public function store(StoreRequest $request)
    {
        CondicionesPago::create($request->validated());
        return redirect()->route('admin.condicion-pagos.index')->with('flash', 'Condicion de pago creado corretamente');
    }

    public function edit(CondicionesPago $condicion_pago)
    {
        return view('admin.condicionesPago.edit', [
            'condicion' => $condicion_pago
        ]);
    }

    public function update(UpdateRequest $request, CondicionesPago $condicion_pago)
    {
        $condicion_pago->update($request->validated());
        return redirect()->route('admin.condicion-pagos.index')->with('flash', 'Condicion de pago actualizado corretamente');
    }

    public function destroy(CondicionesPago $condicion_pago)
    {
        $condicion_pago->delete();
        return redirect()->route('admin.condicion-pagos.index')->with('flash', 'Condicion de pago eliminado corretamente');
    }
}
