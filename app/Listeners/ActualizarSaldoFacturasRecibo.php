<?php

namespace App\Listeners;

use App\Events\ReciboCreado;
use App\Models\ClienteFactura;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ActualizarSaldoFacturasRecibo
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
        foreach (request()->input('facturas', []) as $factura) {
            $facturaModel = ClienteFactura::find($factura['id']);
            if ($facturaModel) {
                $facturaModel->update([
                    'saldo_total' => $facturaModel->saldo_total - $factura['pago']
                ]);
            } else {
                Log::warning("Factura con ID {$factura['id']} no encontrada.");
            }
        }
    }
}
