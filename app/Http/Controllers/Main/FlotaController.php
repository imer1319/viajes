<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Flota\StoreRequest;
use App\Http\Requests\Flota\UpdateRequest;
use App\Models\Flota;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FlotaController extends Controller
{
    public function index()
    {
        return view('admin.flotas.index', [
            'flotas' => Flota::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.flotas.create', [
            'flota' => new Flota(),
        ]);
    }

    public function show(Flota $flota)
    {
        return view('admin.flotas.show', [
            'flota' => $flota
        ]);
    }

    public function edit(Flota $flota)
    {
        return view('admin.flotas.edit', [
            'flota' => $flota
        ]);
    }

    public function update(UpdateRequest $request,Flota $flota)
    {
        $res = $flota->update($request->validated());

        if ($res) {
            return response()->json(['message' => 'Flota actualizada correctamente'], 201);
        }
        return response()->json(['message' => 'Error al actualizar la nueva flota'], 500);
    }

    public function destroy(Flota $flota)
    {
        $flota->delete();
        return redirect()->route('admin.flotas.index')->with('flash', 'Flota eliminada corretamente');
    }

    public function print()
    {
        $flotas = Flota::query()
            ->latest()
            ->get();
       
        $pdf = Pdf::loadView('reportes.flotas', compact('flotas'));

        $pdf->setPaper('A4', 'landscape');

        $pdf->set_option('isHtml5ParserEnabled', true);

        return $pdf->stream();
    }
}
