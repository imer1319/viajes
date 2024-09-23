<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Liquidacion;
use App\Events\LiquidacionCreada;
use App\Events\LiquidacionEliminada;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Liquidacion\GastoRequest;
use App\Http\Requests\Liquidacion\HeadRequest;
use App\Http\Requests\Liquidacion\AnticipoRequest;
use App\Http\Requests\Liquidacion\MovimientoRequest;
use App\Http\Requests\Liquidacion\StoreRequest;
use App\Http\Requests\Liquidacion\UpdateRequest;

class LiquidacionController extends Controller
{
    public function head(HeadRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function movimientos(MovimientoRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function anticipos(AnticipoRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function gastos(GastoRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $liquidacion = Liquidacion::create($request->validated());

            event(new LiquidacionCreada($liquidacion));

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

    public function update(UpdateRequest $request, Liquidacion $liquidacion)
    {
        try {
            DB::beginTransaction();
    
            event(new LiquidacionEliminada($liquidacion));
    
            $liquidacion->update($request->validated());
    
            event(new LiquidacionCreada($liquidacion));
    
            DB::commit();
    
            return response()->json([
                'message' => 'Liquidación actualizada exitosamente.',
                'liquidacion' => $liquidacion,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'message' => 'Hubo un error al actualizar la liquidación.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
