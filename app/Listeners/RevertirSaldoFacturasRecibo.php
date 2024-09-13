<?php

namespace App\Listeners;

use App\Events\ReciboEliminado;
use App\Models\ClienteFactura;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class RevertirSaldoFacturasRecibo
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
    public function handle(ReciboEliminado $event)
    {
        foreach ($event->recibo->facturas as $facturaRecibo) {
            $facturaModel = ClienteFactura::find($facturaRecibo->factura_id);
            if ($facturaModel) {
                $facturaModel->update([
                    'saldo_total' => $facturaModel->saldo_total + $facturaRecibo->pago
                ]);
            } else {
                Log::warning("Factura con ID {$facturaRecibo->factura_id} no encontrada para revertir saldo.");
            }
        }
    }
}
