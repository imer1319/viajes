<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\AnticipoChoferExport;
use App\Http\Controllers\Controller;
use App\Models\AnticipoChofer;
use App\Models\Chofer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AnticipoChoferController extends Controller
{
    public function index(Chofer $chofer)
    {
        $anticipos = $chofer->anticipos()->paginate(8);
        $totales = [
            'importe' => $anticipos->sum('importe'),
            'saldo' => $anticipos->sum('saldo'),
        ];
        return view('admin.anticipoChofer.index', [
            'chofer' => $chofer,
            'anticipos' => $anticipos,
            'totales' => $totales
        ]);
    }

    public function search(Request $request, Chofer $chofer)
    {
        $anticipos = $chofer->anticipos()
            ->bySaldo($request->input('saldo'))
            ->byDesde($request->input('desde'))
            ->byHasta($request->input('hasta'))
            ->latest()
            ->paginate(8);

        $totales = [
            'importe' => $anticipos->sum('importe'),
            'saldo' => $anticipos->sum('saldo'),
        ];

        $anticipos->appends($request->except('page'));
        return view('admin.anticipoChofer.index', [
            'anticipos' => $anticipos,
            'chofer' => $chofer,
            'totales' => $totales
        ]);
    }

    public function create(Chofer $chofer)
    {
        $ultimoAnticipoChofer = AnticipoChofer::latest()->first();
        return view('admin.anticipoChofer.create', [
            'chofer' => $chofer,
            'anticipos' => $chofer->anticipos()->with('chofer')->paginate(8),
            'numero_interno' => $ultimoAnticipoChofer ? $ultimoAnticipoChofer->numero_interno + 1 : 1,
        ]);
    }

    public function edit(Chofer $chofer, AnticipoChofer $anticipo)
    {
        return view('admin.anticipoChofer.edit', [
            'chofer' => $chofer,
            'anticipo' => $anticipo,
            'anticipos' => $chofer->anticipos()->with('chofer')->paginate(8),
        ]);
    }

    public function downloadExcel(Chofer $chofer, Request $request)
    {
        return Excel::download(new AnticipoChoferExport($chofer, $request->all()), 'anticipo_chofer.xlsx');
    }
}
