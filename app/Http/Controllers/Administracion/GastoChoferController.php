<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Chofer;
use App\Models\GastoChofer;

class GastoChoferController extends Controller
{
    public function index(Chofer $chofer)
    {
        return view('admin.gastoChofer.index', [
            'chofer' => $chofer,
            'gastos' => $chofer->anticipos()->with('chofer')->paginate(8)
        ]);
    }

    public function create(Chofer $chofer)
    {
        $ultimoGastoChofer = GastoChofer::latest()->first();
        return view('admin.gastoChofer.create', [
            'chofer' => $chofer,
            'anticipos' => $chofer->anticipos()->with('chofer')->paginate(8),
            'numero_interno' => $ultimoGastoChofer ? $ultimoGastoChofer->id + 1 : 1,
        ]);
    }

    public function edit(Chofer $chofer, GastoChofer $anticipo)
    {
        return view('admin.gastoChofer.edit', [
            'chofer' => $chofer,
            'anticipo' => $anticipo,
            'anticipos' => $chofer->anticipos()->with('chofer')->paginate(8),
        ]);
    }
}
