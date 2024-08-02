<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoViaje\StoreRequest;
use App\Models\TipoViaje;
use Illuminate\Http\Request;

class TipoViajeController extends Controller
{
    public function index()
    {
        $choferes = TipoViaje::all();
        return response()->json($choferes);
    }

    public function store(StoreRequest $request)
    {
        $res = TipoViaje::create($request->validated());
        if ($res) {
            return response()->json(['message' => 'Tipo de viaje creado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al crear el nuevo tipo de viaje'], 500);
    }
}
