<?php

namespace App\Listeners;

use App\Events\AnticipoCreado;
use App\Models\Chofer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActualizarSaldoChoferPorAnticipoCreado
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
    public function handle(AnticipoCreado $event)
    {
        dd($event);
        $chofer = Chofer::find($event->chofer_id);
        $chofer->update([
            'saldo' => $chofer->saldo - $event->importe
        ]);
    }
}
