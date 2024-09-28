<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\GastosExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Gasto\StoreRequest;
use App\Http\Requests\Gasto\UpdateRequest;
use App\Models\Chofer;
use App\Models\Flota;
use App\Models\GastoChofer;
use App\Models\TipoGasto;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class GastoController extends Controller
{
    public function index()
    {
        $gastos = GastoChofer::with('chofer', 'tipoGastos')->paginate(8);
        $totales = [
            'importe' => $gastos->sum('importe'),
            'saldo' => $gastos->sum('saldo'),
        ];
        return view('admin.gastos.index', [
            'gastos' => $gastos,
            'choferes' => Chofer::all(),
            'flotas' => Flota::all(),
            'tipoGastos' => TipoGasto::all(),
            'totales' => $totales
        ]);
    }

    public function search(Request $request)
    {
        $gastos = GastoChofer::query()
            ->byChoferId($request->input('chofer_id'))
            ->byFlotaId($request->input('flota_id'))
            ->bySaldo($request->input('saldo'))
            ->byDesde($request->input('desde'))
            ->byHasta($request->input('hasta'))
            ->byTipoGastoId($request->input('tipo_gasto_id'))
            ->with('chofer', 'tipoGastos')
            ->latest()
            ->paginate(8);

        $gastos->appends($request->except('page'));

        $totales = [
            'importe' => $gastos->sum('importe'),
            'saldo' => $gastos->sum('saldo'),
        ];
        return view('admin.gastos.index', [
            'gastos' => $gastos,
            'choferes' => Chofer::all(),
            'flotas' => Flota::all(),
            'tipoGastos' => TipoGasto::all(),
            'totales' => $totales,
        ]);
    }

    public function create()
    {
        $ultimoGastoChofer = GastoChofer::latest()->first();
        return view('admin.gastos.create', [
            'tipoGastos' => TipoGasto::all(),
            'numero_interno' => $ultimoGastoChofer ? $ultimoGastoChofer->numero_interno + 1 : 1
        ]);
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $gasto = GastoChofer::create($validatedData);
        $chofer = Chofer::find($request->chofer_id);
        $chofer->update([
            'saldo' => $chofer->saldo + $gasto->importe
        ]);
        $tipoGastos = collect($validatedData['tipo_gastos'])->map(function ($tipoGasto) {
            if (is_array($tipoGasto) && isset($tipoGasto['id']) && $tipoGasto['id']) {
                return $tipoGasto['id'];
            } else {
                $nuevoTipoGasto = TipoGasto::create([
                    'descripcion' => is_array($tipoGasto) ? $tipoGasto['descripcion'] : $tipoGasto
                ]);
                return $nuevoTipoGasto->id;
            }
        });

        $gasto->tipoGastos()->sync($tipoGastos);
        if ($gasto) {
            return response()->json(['message' => 'Gasto creado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al crear el nuevo gasto'], 500);
    }

    public function show(GastoChofer $gasto)
    {
        return view('admin.gastos.show', [
            'gasto' => $gasto
        ]);
    }

    public function edit(GastoChofer $gasto)
    {
        return view('admin.gastos.edit', [
            'gasto' => $gasto->load('tipoGastos'),
            'tipoGastos' => TipoGasto::all(),
        ]);
    }

    public function update(UpdateRequest $request, GastoChofer $gasto)
    {
        $valorAnterior = $gasto->importe;
        $validatedData = $request->validated();
        $respuesta = $gasto->update($validatedData);
        $tipoGastos = collect($validatedData['tipo_gastos'])->map(function ($tipoGasto) {
            if (is_array($tipoGasto) && isset($tipoGasto['id']) && $tipoGasto['id']) {
                return $tipoGasto['id'];
            } else {
                $nuevoTipoGasto = TipoGasto::create([
                    'descripcion' => is_array($tipoGasto) ? $tipoGasto['descripcion'] : $tipoGasto
                ]);
                return $nuevoTipoGasto->id;
            }
        });

        $gasto->tipoGastos()->sync($tipoGastos);
        if ($respuesta) {
            $diferencia = $request->importe - $valorAnterior;
            $chofer = $gasto->chofer;
            $chofer->update([
                'saldo' => $chofer->saldo - $diferencia
            ]);
            return response()->json(['message' => 'Gasto actualizado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al actualizar el nuevo gasto'], 500);
    }

    public function destroy(GastoChofer $gasto)
    {
        $chofer = Chofer::find($gasto->chofer_id);

        $chofer->update([
            'saldo' => $chofer->saldo - $gasto->importe
        ]);

        $gasto->delete();
        return redirect()->route('admin.gastos.index')->with('flash', 'Gasto eliminado corretamente');
    }

    public function downloadExcel(Request $request)
    {
        return Excel::download(new GastosExport($request->all()), 'gastos.xlsx');
    }

    public function print(Request $request)
    {
        $gastos = GastoChofer::query()
            ->byChoferId($request->input('chofer_id'))
            ->byFlotaId($request->input('flota_id'))
            ->bySaldo($request->input('saldo'))
            ->byDesde($request->input('desde'))
            ->byHasta($request->input('hasta'))
            ->byTipoGastoId($request->input('tipo_gasto_id'))
            ->with('chofer', 'tipoGastos')
            ->get();

        $totales = [
            'importe' => $gastos->sum('importe'),
            'saldo' => $gastos->sum('saldo'),
        ];

        $pdf = Pdf::loadView('reportes.gastos', compact('gastos', 'totales'));

        $pdf->setPaper('A4', 'landscape');

        $pdf->set_option('isHtml5ParserEnabled', true);

        return $pdf->stream();
    }
}
