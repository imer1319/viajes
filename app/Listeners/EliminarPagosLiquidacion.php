<?php

namespace App\Listeners;

use App\Events\LiquidacionEliminada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EliminarPagosLiquidacion
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
    public function handle(LiquidacionEliminada $event)
    {
        $event->liquidacion->pagos()->delete();
    }
}
