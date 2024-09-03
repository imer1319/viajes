<?php

namespace App\Http\Controllers\Api;

use App\Events\LiquidacionCreada;
use App\Events\LiquidacionEliminada;
use App\Http\Controllers\Controller;
use App\Http\Requests\Liquidacion\AnticipoRequest;
use App\Http\Requests\Liquidacion\GastoRequest;
use App\Http\Requests\Liquidacion\HeadRequest;
use App\Http\Requests\Liquidacion\MovimientoRequest;
use App\Http\Requests\Liquidacion\StoreRequest;
use App\Http\Requests\Liquidacion\UpdateRequest;
use App\Models\AnticipoChofer;
use App\Models\Chofer;
use App\Models\GastoChofer;
use App\Models\Liquidacion;
use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
            $movimientos = Movimiento::whereIn('id', collect($request->movimientos)->pluck('id'))->get();
            $anticipos = AnticipoChofer::whereIn('id', collect($request->anticipos)->pluck('id'))->get();
            $gastos = GastoChofer::whereIn('id', collect($request->gastos)->pluck('id'))->get();

            event(new LiquidacionCreada($request->chofer_id, $liquidacion->id, $movimientos, $anticipos, $gastos));
            $chofer = Chofer::find($request->chofer_id);
            $chofer->update([
                'saldo' => $chofer->saldo - $request->total_liquidacion
            ]);
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
    
            $saldoAnterior = $liquidacion->total_liquidacion;
    
            event(new LiquidacionEliminada($liquidacion->chofer_id, $liquidacion->id));
    
            $liquidacion->update($request->validated());
    
            $movimientos = Movimiento::whereIn('id', collect($request->movimientos)->pluck('id'))->get();
            $anticipos = AnticipoChofer::whereIn('id', collect($request->anticipos)->pluck('id'))->get();
            $gastos = GastoChofer::whereIn('id', collect($request->gastos)->pluck('id'))->get();
    
            event(new LiquidacionCreada($request->chofer_id, $liquidacion->id, $movimientos, $anticipos, $gastos));
    
            $chofer = Chofer::find($request->chofer_id);
    
            $nuevoSaldo = $chofer->saldo + $saldoAnterior - $request->total_liquidacion;
    
            $chofer->update([
                'saldo' => $nuevoSaldo
            ]);
    
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
