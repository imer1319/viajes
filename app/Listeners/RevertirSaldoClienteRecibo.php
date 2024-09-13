<?php

namespace App\Listeners;

use App\Events\ReciboEliminado;
use App\Models\Cliente;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RevertirSaldoClienteRecibo
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
        $recibo = $event->recibo;
        $cliente = Cliente::find($recibo->cliente_id);

        if ($cliente) {
            $cliente->update([
                'saldo' => $cliente->saldo + $recibo->total_recibo
            ]);
        }
    }
}
