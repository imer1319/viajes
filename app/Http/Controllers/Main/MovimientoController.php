<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movimiento\StoreRequest;
use App\Http\Requests\Movimiento\UpdateRequest;
use App\Models\Chofer;
use App\Models\Cliente;
use App\Models\Flota;
use App\Models\Movimiento;
use App\Models\TipoViaje;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index()
    {
        return view('admin.retencionGanancias.index', [
            'movimientos' => Movimiento::latest()->paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.movimientos.create', [
            'movimiento' => new Movimiento(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        Movimiento::create($request->validated());
        return redirect()->route('admin.retencion-ganancias.index')->with('flash', 'Retencion de ganancias creada corretamente');
    }

    public function edit(Movimiento $movimiento)
    {
        return view('admin.retencionGanancias.edit', [
            'ganancia' => $movimiento
        ]);
    }

    public function update(Movimiento $movimiento, UpdateRequest $request)
    {
        $movimiento->update($request->validated());
        return redirect()->route('admin.movimientos.index')->with('flash','Retencion de ganancias bruto actualizada corretamente');
    }

    public function destroy(Movimiento $movimiento)
    {
        $movimiento->delete();
        return redirect()->route('admin.retencion-ganancias.index')->with('flash', 'Retencion de ganancias bruto eliminado corretamente');
    }
}
