<?php

namespace App\Listeners;

use App\Events\LiquidacionEliminada;
use App\Models\LiquidacionMovimiento;
use App\Models\Movimiento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EliminarMovimientosListener
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
    public function handle(LiquidacionEliminada $event)
    {
        $liquidacionMovimientos = LiquidacionMovimiento::where('liquidacion_id', $event->liquidacion_id)->get();

        foreach ($liquidacionMovimientos as $liquidacionMovimiento) {
            $movimiento = Movimiento::find($liquidacionMovimiento->movimiento_id);

            if ($movimiento) {
                $movimiento->update([
                    'saldo_total' => $movimiento->saldo_total + $liquidacionMovimiento->importe,
                    'saldo_comision_chofer' => $movimiento->saldo_comision_chofer + $liquidacionMovimiento->importe,
                ]);
            }
            $liquidacionMovimiento->delete();
        }
    }
}
