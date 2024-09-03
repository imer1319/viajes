<?php

namespace App\Listeners;

use App\Events\FacturaCreada;
use App\Models\Movimiento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActualizarMovimientosFactura
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
    public function handle(FacturaCreada $event)
    {
        $factura = $event->factura;
        $movimientos = $event->movimientos;

        foreach ($movimientos as $movimiento) {
            Movimiento::where('id', $movimiento['id'])->update(['facturado' => true]);

            $factura->detalles()->create([
                'movimiento_id' => $movimiento['id'],
            ]);
        }
    }
}
