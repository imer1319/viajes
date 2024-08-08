<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Proveedor\StoreRequest;
use App\Http\Requests\Proveedor\UpdateRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        return view('admin.proveedores.index', [
            'proveedores' => Proveedor::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.proveedores.create', [
            'proveedor' => new Proveedor(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        Proveedor::create($request->validated());
        return redirect()->route('admin.proveedores.index')->with('flash', 'Proveedor creado corretamente');
    }

    public function show(Proveedor $proveedore)
    {
        return view('admin.proveedores.show', [
            'proveedor' => $proveedore->load(
                'ordenCompras',
                'provincia',
                'departamento',
                'localidad',
                'retencionIngresoBruto',
                'planCuenta',
                'retencionGanancia',
                'condicionIva'
            )
        ]);
    }

    public function edit(Proveedor $proveedore)
    {
        return view('admin.proveedores.edit', [
            'proveedor' => $proveedore
        ]);
    }

    public function update(UpdateRequest $request, Proveedor $proveedore)
    {
        $res = $proveedore->update($request->validated());

        if ($res) {
            return response()->json(['message' => 'Proveedor actualizado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al actualizar el nuevo chofer'], 500);
    }

    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete();
        return redirect()->route('admin.proveedores.index')->with('flash', 'Proveedor eliminado corretamente');
    }
}
