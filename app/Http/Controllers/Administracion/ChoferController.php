<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\ChoferExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chofer\StoreRequest;
use App\Http\Requests\Chofer\UpdateRequest;
use App\Models\Chofer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ChoferController extends Controller
{
    public function index()
    {
        $choferes =  Chofer::paginate(8);

        $totales = [
            'saldo' => $choferes->sum('saldo'),
        ];
        return view('admin.choferes.index', [
            'choferes' => $choferes,
            'totales' => $totales,
        ]);
    }

    public function search(Request $request)
    {
        $choferes = Chofer::query()
            ->bySaldo($request->input('saldo'))
            ->latest()
            ->paginate(8);

        $choferes->appends($request->except('page'));

        $totales = [
            'saldo' => $choferes->sum('saldo'),
        ];
        return view('admin.choferes.index', [
            'choferes' => $choferes,
            'totales' => $totales,
        ]);
    }

    public function create()
    {
        return view('admin.choferes.create', [
            'chofer' => new Chofer(),
        ]);
    }

    public function show(Chofer $chofere)
    {
        return view('admin.choferes.show', [
            'chofer' => $chofere->load([
                'anticipos' => function ($query) {
                    $query->where('saldo', '!=', 0);
                },
                'gastos' => function ($query) {
                    $query->where('saldo', '!=', 0);
                }
            ])
        ]);
    }

    public function edit(Chofer $chofere)
    {
        return view('admin.choferes.edit', [
            'chofer' => $chofere
        ]);
    }

    public function update(UpdateRequest $request, Chofer $chofere)
    {
        $res = $chofere->update($request->validated());

        if ($res) {
            return response()->json(['message' => 'Chofer actualizado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al actualizar el nuevo chofer'], 500);
    }

    public function destroy(Chofer $chofere)
    {
        $chofere->delete();
        return redirect()->route('admin.choferes.index')->with('flash', 'Chofer eliminado corretamente');
    }

    public function downloadExcel(Chofer $chofer)
    {
        return Excel::download(new ChoferExport($chofer), 'choferes.xlsx');
    }

    public function print(Request $request)
    {
        $choferes = Chofer::query()
            ->bySaldo($request->input('saldo'))
            ->paginate(8);

        $totales = [
            'saldo' => $choferes->sum('saldo'),
        ];

        $pdf = Pdf::loadView('reportes.choferes', compact('choferes', 'totales'));

        $pdf->setPaper('A4', 'landscape');

        $pdf->set_option('isHtml5ParserEnabled', true);

        return $pdf->stream();
    }
}
