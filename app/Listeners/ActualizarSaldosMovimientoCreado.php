<?php

namespace App\Listeners;

use App\Events\MovimientoCreado;
use App\Models\Chofer;
use App\Models\Cliente;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActualizarSaldosMovimientoCreado
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
    public function handle(MovimientoCreado $event)
    {
        $chofer = Chofer::findOrFail($event->movimiento->chofer_id);
        $chofer->saldo += $event->movimiento->comision_chofer;
        $chofer->save();
        
        $cliente = Cliente::findOrFail($event->movimiento->cliente_id);
        $cliente->saldo += $event->movimiento->total;
        $cliente->save();
    }
}
