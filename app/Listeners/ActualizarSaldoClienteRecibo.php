<?php

namespace App\Listeners;

use App\Events\ReciboCreado;
use App\Models\Cliente;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActualizarSaldoClienteRecibo
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
        $cliente = Cliente::find(request()->cliente_id);

        if ($cliente) {
            $cliente->update([
                'saldo' => $cliente->saldo - $recibo->total_recibo
            ]);
        }
    }
}
