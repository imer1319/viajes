<?php

namespace App\Listeners;

use App\Events\LiquidacionCreada;
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
        foreach ($event->anticipos as $anticipo) {
            LiquidacionAnticipo::create([
                'chofer_id' => $event->chofer_id,
                'anticipo_id' => $anticipo['id'],
                'importe' => $anticipo['importe'],
                'liquidacion_id' => $event->liquidacion_id,
            ]);
        }
    }
}
