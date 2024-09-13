<?php

namespace App\Listeners;

use App\Events\ReciboEliminado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EliminarFacturasRecibo
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
        $event->recibo->facturas()->delete();
    }
}
