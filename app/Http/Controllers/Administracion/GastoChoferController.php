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
        $gastos = GastoChofer::with('chofer')->paginate(8);
        $totales = [
            'importe' => $gastos->sum('importe'),
            'saldo' => $gastos->sum('saldo'),
        ];
        return view('admin.gastoChofer.index', [
            'chofer' => $chofer,
            'gastos' => $chofer->gastos()->paginate(8),
            'choferes' => Chofer::all(),
            'flotas' => Flota::all(),
            'totales' => $totales
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
        $totales = [
            'importe' => $gastos->sum('importe'),
            'saldo' => $gastos->sum('saldo'),
        ];
        $gastos->appends($request->except('page'));
        return view('admin.gastoChofer.index', [
            'gastos' => $gastos,
            'chofer' => $chofer,
            'flotas' => Flota::all(),
            'totales' => $totales,
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
