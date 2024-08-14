<?php

namespace App\Listeners;

use App\Events\MovimientoEliminado;
use App\Models\FacturaMovimiento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EliminarFacturaMovimiento
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
    public function handle(MovimientoEliminado $event)
    {
        $movimiento = $event->movimiento;

        FacturaMovimiento::where('movimiento_id', $movimiento->id)->delete();
    }
}
