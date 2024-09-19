<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\GastoChoferExport;
use App\Http\Controllers\Controller;
use App\Models\Chofer;
use App\Models\Flota;
use App\Models\GastoChofer;
use App\Models\TipoGasto;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GastoChoferController extends Controller
{
    public function index(Chofer $chofer)
    {
        return view('admin.gastoChofer.index', [
            'chofer' => $chofer,
            'gastos' => $chofer->gastos()->paginate(8),
            'choferes' => Chofer::all(),
            'flotas' => Flota::all()
        ]);
    }

    public function search(Chofer $chofer, Request $request)
    {
        $gastos = $chofer->gastos()
            ->byFlotaId($request->input('flota_id'))
            ->bySaldo($request->input('saldo'))
            ->byDesde($request->input('desde'))
            ->byHasta($request->input('hasta'))
            ->with('chofer')
            ->latest()
            ->paginate(8);

        $gastos->appends($request->except('page'));
        return view('admin.gastos.index', [
            'gastos' => $gastos,
            'choferes' => Chofer::all(),
            'flotas' => Flota::all()
        ]);
    }

    public function create(Chofer $chofer)
    {
        $ultimoGastoChofer = GastoChofer::latest()->first();
        return view('admin.gastoChofer.create', [
            'chofer' => $chofer,
            'tipoGastos' => TipoGasto::all(),
            'numero_interno' => $ultimoGastoChofer ? $ultimoGastoChofer->numero_interno + 1 : 1,
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

    public function downloadExcel(Chofer $chofer, Request $request)
    {
        return Excel::download(new GastoChoferExport($chofer, $request->all()), 'gasto_chofer.xlsx');
    }
}
