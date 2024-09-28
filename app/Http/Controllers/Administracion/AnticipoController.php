<?php

namespace App\Http\Controllers\Administracion;

use App\Events\AnticipoCreado;
use App\Events\AnticipoEliminado;
use App\Exports\AnticiposExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Anticipo\StoreRequest;
use App\Http\Requests\Anticipo\UpdateRequest;
use App\Models\AnticipoChofer;
use App\Models\Chofer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AnticipoController extends Controller
{
    public function index()
    {
        $anticipos = AnticipoChofer::with('chofer')->paginate(8);
        $totales = [
            'importe' => $anticipos->sum('importe'),
            'saldo' => $anticipos->sum('saldo'),
        ];
        return view('admin.anticipos.index', [
            'anticipos' => $anticipos,
            'choferes' => Chofer::all(),
            'totales' => $totales,
        ]);
    }

    public function search(Request $request)
    {
        $anticipos = AnticipoChofer::query()
            ->byChoferId($request->input('chofer_id'))
            ->bySaldo($request->input('saldo'))
            ->byDesde($request->input('desde'))
            ->byHasta($request->input('hasta'))
            ->with('chofer')
            ->latest()
            ->paginate(8);

        $anticipos->appends($request->except('page'));

        $totales = [
            'importe' => $anticipos->sum('importe'),
            'saldo' => $anticipos->sum('saldo'),
        ];

        return view('admin.anticipos.index', [
            'anticipos' => $anticipos,
            'choferes' => Chofer::all(),
            'totales' => $totales,
        ]);
    }

    public function create()
    {
        $ultimoAnticipoChofer = AnticipoChofer::latest()->first();
        $numeroInterno = $ultimoAnticipoChofer ? $ultimoAnticipoChofer->numero_interno + 1 : 1;
        return view('admin.anticipos.create', [
            'numero_interno' => $numeroInterno
        ]);
    }

    public function store(StoreRequest $request)
    {
        $anticipo = AnticipoChofer::create($request->validated());
        $chofer = Chofer::find($request->chofer_id);
        $chofer->update([
            'saldo' => $chofer->saldo - $anticipo->importe
        ]);

        if ($anticipo) {
            return response()->json(['message' => 'Anticipo creado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al crear el nuevo anticipo'], 500);
    }

    public function show(AnticipoChofer $anticipo)
    {
        return view('admin.anticipos.show', [
            'anticipo' => $anticipo
        ]);
    }

    public function edit(AnticipoChofer $anticipo)
    {
        return view('admin.anticipos.edit', [
            'anticipo' => $anticipo
        ]);
    }

    public function update(UpdateRequest $request, AnticipoChofer $anticipo)
    {
        $valorAnterior = $anticipo->importe;
        $respuesta = $anticipo->update($request->validated());

        if ($respuesta) {
            $diferencia = $request->importe - $valorAnterior;
            $chofer = $anticipo->chofer;
            $chofer->update([
                'saldo' => $chofer->saldo - $diferencia
            ]);
            return response()->json(['message' => 'Anticipo actualizado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al actualizar el anticipo'], 500);
    }

    public function destroy(AnticipoChofer $anticipo)
    {
        $chofer = $anticipo->chofer;
        
        $chofer->update([
            'saldo' => $chofer->saldo + $anticipo->importe
        ]);
        
        $anticipo->delete();

        return redirect()->route('admin.anticipos.index')->with('flash', 'Anticipo eliminado corretamente');
    }

    public function downloadExcel(Request $request)
    {
        return Excel::download(new AnticiposExport($request->all()), 'anticipos.xlsx');
    }


    public function print(Request $request)
    {
        $anticipos = AnticipoChofer::query()
            ->byChoferId($request->input('chofer_id'))
            ->bySaldo($request->input('saldo'))
            ->byDesde($request->input('desde'))
            ->byHasta($request->input('hasta'))
            ->with('chofer')
            ->get();
        $totales = [
            'importe' => $anticipos->sum('importe'),
            'saldo' => $anticipos->sum('saldo'),
        ];

        $pdf = Pdf::loadView('reportes.anticipos', compact('anticipos', 'totales'));

        $pdf->setPaper('A4', 'landscape');

        $pdf->set_option('isHtml5ParserEnabled', true);

        return $pdf->stream();
    }
}
