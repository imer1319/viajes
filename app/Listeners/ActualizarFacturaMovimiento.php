<?php

namespace App\Listeners;

use App\Events\MovimientoActualizado;
use App\Models\FacturaMovimiento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActualizarFacturaMovimiento
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
    public function handle(MovimientoActualizado $event)
    {
        $movimiento = $event->movimiento;

        $factura = FacturaMovimiento::where('movimiento_id', $movimiento->id)->first();
        if ($factura) {
            $factura->update([
                'fecha' => now(),
                'detalle' => 'Detalles actualizados de la factura',
                'iva' => $movimiento->iva,
                'neto' => $movimiento->neto,
                'total' => $movimiento->total,
                'saldo_total' => $movimiento->saldo_total,
            ]);
        }
    }
}
