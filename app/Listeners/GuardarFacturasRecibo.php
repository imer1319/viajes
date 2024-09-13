<?php

namespace App\Listeners;

use App\Events\ReciboCreado;
use App\Models\FacturaRecibo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GuardarFacturasRecibo
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
    public function handle(ReciboCreado $event)
    {
        $recibo = $event->recibo;

        foreach (request()->input('facturas', []) as $factura) {
            FacturaRecibo::create([
                'factura_id' => $factura['id'],
                'pago' => $factura['pago'],
                'recibo_id' => $recibo->id
            ]);
        }
    }
}
