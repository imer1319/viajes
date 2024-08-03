<?php

namespace App\Listeners;

use App\Events\MovimientoEliminado;
use App\Models\Chofer;
use App\Models\Cliente;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActualizarSaldosMovimientoEliminado
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
        $cliente = Cliente::findOrFail($event->movimiento->cliente_id);
        $chofer = Chofer::findOrFail($event->movimiento->chofer_id);

        $cliente->saldo -= $event->movimiento->total;
        $chofer->saldo -= $event->movimiento->comision_chofer;

        $cliente->save();
        $chofer->save();
    }
}
