<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Flota\StoreRequest;
use App\Models\Flota;
use Illuminate\Http\Request;

class FlotaController extends Controller
{
    public function index()
    {
        $choferes = Flota::all();
        return response()->json($choferes);
    }

    public function store(StoreRequest $request)
    {
        $res = Flota::create($request->validated());
        if ($res) {
            return response()->json(['message' => 'Flota creado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al crear el nuevo chofer'], 500);
    }
}
