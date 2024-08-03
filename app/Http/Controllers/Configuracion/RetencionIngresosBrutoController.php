<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\RetencionIngresoBruto\StoreRequest;
use App\Http\Requests\RetencionIngresoBruto\UpdateRequest;
use App\Models\RetencionIngresosBruto;

class RetencionIngresosBrutoController extends Controller
{
    public function index()
    {
        return view('admin.retencionIngresosBruto.index', [
            'ingresos' => RetencionIngresosBruto::latest()->paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.retencionIngresosBruto.create', [
            'ingreso' => new RetencionIngresosBruto()
        ]);
    }

    public function store(Storerequest $request)
    {
        RetencionIngresosBruto::create($request->validated());
        return redirect()->route('admin.retencion-ingresos-bruto.index')->with('flash', 'Retencion de ingresos bruto creada corretamente');
    }

    public function edit(RetencionIngresosBruto $retencion_ingresos_bruto)
    {
        return view('admin.retencionIngresosBruto.edit', [
            'ingreso' => $retencion_ingresos_bruto
        ]);
    }

    public function update(RetencionIngresosBruto $retencion_ingresos_bruto, UpdateRequest $request)
    {
        $retencion_ingresos_bruto->update($request->validated());
        return redirect()->route('admin.retencion-ingresos-bruto.index')->with('flash','Retencion de ingresos bruto actualizada corretamente');
    }

    public function destroy(RetencionIngresosBruto $retencion_ingresos_bruto)
    {
        $retencion_ingresos_bruto->delete();
        return redirect()->route('admin.retencion-ingresos-bruto.index')->with('flash', 'Retencion de ingresos bruto eliminado corretamente');
    }
}
