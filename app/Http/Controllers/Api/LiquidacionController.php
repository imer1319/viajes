<?php

namespace App\Http\Controllers\Api;

use App\Events\LiquidacionCreada;
use App\Http\Controllers\Controller;
use App\Http\Requests\Liquidacion\HeadRequest;
use App\Http\Requests\Liquidacion\StoreRequest;
use App\Models\AnticipoChofer;
use App\Models\GastoChofer;
use App\Models\Liquidacion;
use App\Models\Movimiento;
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
            $movimientos = Movimiento::whereIn('id', collect($request->movimientos)->pluck('id'))->get();
            $anticipos = AnticipoChofer::whereIn('id', collect($request->anticipos)->pluck('id'))->get();
            $gastos = GastoChofer::whereIn('id', collect($request->gastos)->pluck('id'))->get();

            event(new LiquidacionCreada($request->chofer_id, $liquidacion->id, $movimientos, $anticipos, $gastos));
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
