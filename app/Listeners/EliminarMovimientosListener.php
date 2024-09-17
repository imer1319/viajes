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
        $liquidacion = $event->liquidacion;
        $liquidacionMovimientos = LiquidacionMovimiento::where('liquidacion_id', $liquidacion->id)->get();

        foreach ($liquidacionMovimientos as $liquidacionMovimiento) {
            $movimiento = Movimiento::find($liquidacionMovimiento->movimiento_id);

            if ($movimiento) {
                $movimiento->update([
                    'saldo_total' => $movimiento->total ,
                    'saldo_comision_chofer' => $movimiento->comision_chofer,
                ]);
            }
            $liquidacionMovimiento->delete();
        }
    }
}
