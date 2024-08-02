<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\StoreRequest;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $choferes = Cliente::all();
        return response()->json($choferes);
    }

    public function store(StoreRequest $request)
    {
        $res = Cliente::create($request->validated());
        if ($res) {
            return response()->json(['message' => 'Cliente creado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al crear el nuevo chofer'], 500);
    }
}
