<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chofer\StoreRequest;
use App\Models\Chofer;
use Illuminate\Http\Request;

class ChoferController extends Controller
{
    public function index()
    {
        $choferes = Chofer::all();
        return response()->json($choferes);
    }

    public function store(StoreRequest $request)
    {
        $res = Chofer::create($request->validated());
        if ($res) {
            return response()->json(['message' => 'Chofer creado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al crear el nuevo chofer'], 500);
    }
}
