<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\GastoChoferExport;
use App\Http\Controllers\Controller;
use App\Models\Chofer;
use App\Models\GastoChofer;
use App\Models\TipoGasto;
use Maatwebsite\Excel\Facades\Excel;

class GastoChoferController extends Controller
{
    public function index(Chofer $chofer)
    {
        return view('admin.gastoChofer.index', [
            'chofer' => $chofer,
            'gastos' => $chofer->gastos()->paginate(8)
        ]);
    }

    public function create(Chofer $chofer)
    {
        $ultimoGastoChofer = GastoChofer::latest()->first();
        return view('admin.gastoChofer.create', [
            'chofer' => $chofer,
            'tipoGastos' => TipoGasto::all(),
            'numero_interno' => $ultimoGastoChofer ? $ultimoGastoChofer->id + 1 : 1,
        ]);
    }

    public function edit(Chofer $chofer, GastoChofer $gasto)
    {
        return view('admin.gastoChofer.edit', [
            'chofer' => $chofer,
            'gasto' => $gasto,
            'tipoGastos' => TipoGasto::all(),
        ]);
    }

    public function show(Chofer $chofer, GastoChofer $gasto)
    {
        return view('admin.gastoChofer.show', [
            'chofer' => $chofer,
            'gasto' => $gasto,
        ]);
    }

    public function downloadExcel(Chofer $chofer)
    {
        return Excel::download(new GastoChoferExport($chofer), 'gasto_chofer.xlsx');
    }
}
