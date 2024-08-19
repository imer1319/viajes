<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Proveedor\StoreRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return response()->json($proveedores);
    }

    public function store(StoreRequest $request)
    {
        $res = Proveedor::create($request->validated());
        if ($res) {
            return response()->json(['message' => 'Proveedor creado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al crear el nuevo chofer'], 500);
    }
}
