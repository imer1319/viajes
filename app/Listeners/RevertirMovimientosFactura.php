<?php

namespace App\Listeners;

use App\Events\FacturaEliminada;
use App\Models\Movimiento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RevertirMovimientosFactura
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
    public function handle(FacturaEliminada $event)
    {
        $factura = $event->factura;
        $movimientos = $event->movimientos;

        foreach ($movimientos as $movimiento) {
            $movimiento->update(['facturado' => false]);
            $factura->detalles()->where('movimiento_id', $movimiento->id)->delete();
        }
    }
}
