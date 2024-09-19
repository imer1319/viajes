<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoViaje\StoreRequest;
use App\Http\Requests\TipoViaje\UpdateRequest;
use App\Models\TipoViaje;
use Illuminate\Http\Request;

class TipoViajeController extends Controller
{
    public function index()
    {
        return view('admin.tipoviaje.index', [
            'tipoViajes' => TipoViaje::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.tipoviaje.create', [
            'tipo_viaje' => new TipoViaje()
        ]);
    }

    public function store(StoreRequest $request)
    {
        TipoViaje::create($request->validated());
        return redirect()->route('admin.tipo-viajes.index')->with('flash', 'Tipo de viaje creado corretamente');
    }

    public function edit(TipoViaje $tipo_viaje)
    {
        return view('admin.tipoviaje.edit', [
            'tipo_viaje' => $tipo_viaje
        ]);
    }

    public function update(UpdateRequest $request, TipoViaje $tipo_viaje)
    {
        $tipo_viaje->update($request->validated());
        return redirect()->route('admin.tipo-viajes.index')->with('flash', 'Tipo de viaje actualizado corretamente');
    }

    public function destroy(TipoViaje $tipo_viaje)
    {
        $tipo_viaje->delete();
        return redirect()->route('admin.tipo-viajes.index')->with('flash', 'Tipo de viaje eliminado corretamente');
    }
}
