<?php

namespace App\Listeners;

use App\Events\LiquidacionCreada;
use App\Models\AnticipoChofer;
use App\Models\LiquidacionAnticipo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GuardarAnticiposListener
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
        foreach (request()->input('anticipos', []) as $anticipo) {
            LiquidacionAnticipo::create([
                'chofer_id' => $liquidacion->chofer_id,
                'anticipo_id' => $anticipo['id'],
                'importe' => $anticipo['importe'],
                'liquidacion_id' => $liquidacion->id,
            ]);
            $anti = AnticipoChofer::find($anticipo["id"]);
            $anti->update([
                'saldo' => 0
            ]);
        }
    }
}
