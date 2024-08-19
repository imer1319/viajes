<?php

namespace App\Http\Controllers\Api;

use App\Events\LiquidacionCreada;
use App\Http\Controllers\Controller;
use App\Http\Requests\Liquidacion\HeadRequest;
use App\Http\Requests\Liquidacion\StoreRequest;
use App\Models\Liquidacion;
use Illuminate\Support\Facades\DB;

class LiquidacionController extends Controller
{
    public function head(HeadRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $liquidacion = Liquidacion::create($request->validated());
            event(new LiquidacionCreada($request->chofer_id, $liquidacion->id, $request->movimientos, $request->anticipos, $request->gastos));
            DB::commit();
            return response()->json([
                'message' => 'Liquidacion creado exitosamente.',
                'liquidacion' => $liquidacion,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Hubo un error al crear el liquidacion.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
