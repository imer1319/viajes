<?php

namespace App\Listeners;

use App\Events\LiquidacionEliminada;
use App\Models\Chofer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RevertirSaldoChoferLiquidacion
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
        $liquidacion = $event->liquidacion;
        $chofer = Chofer::find($liquidacion->chofer_id);
            $chofer->update([
                'saldo' => $chofer->saldo + $liquidacion->total_liquidacion
            ]);
    }
}
