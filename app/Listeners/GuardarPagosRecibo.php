<?php

namespace App\Listeners;

use App\Events\ReciboCreado;
use App\Models\PagoRecibo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GuardarPagosRecibo
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

        foreach (request()->input('formaPagos', []) as $pago) {
            PagoRecibo::create([
                'recibo_id' => $recibo->id,
                'forma_pago_id' => $pago['forma_pago_id'],
                'banco_id' => $pago['banco_id'],
                'importe' => $pago['importe'],
                'fecha_emision' => $pago['fecha_emision'],
                'fecha_vencimiento' => $pago['fecha_vencimiento'],
                'nro' => $pago['numero'],
                'abreviacion' => $pago['abreviacion'],
                'descripcion' => $pago['descripcion'],
            ]);
        }
    }
}
