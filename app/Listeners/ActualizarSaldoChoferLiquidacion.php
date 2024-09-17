<?php

namespace App\Listeners;

use App\Events\LiquidacionCreada;
use App\Models\Chofer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActualizarSaldoChoferLiquidacion
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
        $chofer = Chofer::find(request()->chofer_id);
        $chofer->update([
            'saldo' => $chofer->saldo - request()->total_liquidacion
        ]);
    }
}
