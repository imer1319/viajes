<?php

namespace App\Http\Controllers\configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\RetencionGanancias\StoreRequest;
use App\Http\Requests\RetencionGanancias\UpdateRequest;
use App\Models\RetencionGanancia;
use Illuminate\Http\Request;

class RetencionGananciasController extends Controller
{
    public function index()
    {
        return view('admin.retencionGanancias.index', [
            'ganancias' => RetencionGanancia::latest()->paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.retencionGanancias.create', [
            'ganancia' => new RetencionGanancia()
        ]);
    }

    public function store(StoreRequest $request)
    {
        RetencionGanancia::create($request->validated());
        return redirect()->route('admin.retencion-ganancias.index')->with('flash', 'Retencion de ganancias creada corretamente');
    }

    public function edit(RetencionGanancia $retencion_ganancia)
    {
        return view('admin.retencionGanancias.edit', [
            'ganancia' => $retencion_ganancia
        ]);
    }

    public function update(RetencionGanancia $retencion_ganancia, UpdateRequest $request)
    {
        $retencion_ganancia->update($request->validated());
        return redirect()->route('admin.retencion-ganancias.index')->with('flash','Retencion de ganancias bruto actualizada corretamente');
    }

    public function destroy(RetencionGanancia $retencion_ganancia)
    {
        $retencion_ganancia->delete();
        return redirect()->route('admin.retencion-ganancias.index')->with('flash', 'Retencion de ganancias bruto eliminado corretamente');
    }
}
