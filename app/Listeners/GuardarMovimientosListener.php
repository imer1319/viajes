<?php

namespace App\Listeners;

use App\Events\LiquidacionCreada;
use App\Models\LiquidacionMovimiento;
use App\Models\Movimiento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GuardarMovimientosListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LiquidacionCreada $event)
    {
        $liquidacion = $event->liquidacion;
        foreach (request()->input('movimientos', []) as $movimiento) {
            LiquidacionMovimiento::create([
                'chofer_id' => $liquidacion->chofer_id,
                'movimiento_id' => $movimiento["id"],
                'fecha' => $movimiento["fecha"],
                'importe' => $movimiento["saldo_total"],
                'liquidacion_id' => $liquidacion["id"],
            ]);
            $movi = Movimiento::find($movimiento["id"]);
            $movi->update([
                'saldo_total' => 0,
                'saldo_comision_chofer' => 0,
            ]);
        }
    }
}
