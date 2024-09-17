<?php

namespace App\Listeners;

use App\Events\LiquidacionCreada;
use App\Models\PagoLiquidacion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GuardarPagosLiquidacion
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
        $liquidacion = $event->liquidacion;

        foreach (request()->input('formaPagos', []) as $pago) {
            PagoLiquidacion::create([
                'liquidacion_id' => $liquidacion->id,
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
