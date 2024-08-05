<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medida\StoreRequest;
use App\Http\Requests\Medida\UpdateRequest;
use App\Models\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    public function index()
    {
        return view('admin.medidas.index', [
            'medidas' => Medida::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.medidas.create', [
            'medida' => new Medida()
        ]);
    }

    public function store(StoreRequest $request)
    {
        Medida::create($request->validated());
        return redirect()->route('admin.medidas.index')->with('flash', 'Medida creada corretamente');
    }

    public function edit(Medida $medida)
    {
        return view('admin.medidas.edit', [
            'medida' => $medida
        ]);
    }

    public function update(UpdateRequest $request, Medida $medida)
    {
        $medida->update($request->validated());
        return redirect()->route('admin.medidas.index')->with('flash', 'Medida actualizada corretamente');
    }

    public function destroy(Medida $medida)
    {
        $medida->delete();
        return redirect()->route('admin.medidas.index')->with('flash', 'Medida eliminada corretamente');
    }
}
