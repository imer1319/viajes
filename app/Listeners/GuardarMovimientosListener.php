<?php

namespace App\Listeners;

use App\Events\LiquidacionCreada;
use App\Models\LiquidacionMovimiento;
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
        foreach ($event->movimientos as $movimiento) {
            LiquidacionMovimiento::create([
                'chofer_id' => $event->chofer_id,
                'movimiento_id' => $movimiento['id'],
                'fecha' => $movimiento['fecha'],
                'importe' => $movimiento['saldo_total'],
                'liquidacion_id' => $event->liquidacion_id,
            ]);
        }
    }
}
