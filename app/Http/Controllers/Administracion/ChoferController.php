<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chofer\StoreRequest;
use App\Http\Requests\Chofer\UpdateRequest;
use App\Models\Chofer;

class ChoferController extends Controller
{
    public function index()
    {
        return view('admin.choferes.index', [
            'choferes' => Chofer::paginate(8)
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
            'chofer' => $chofere
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
}