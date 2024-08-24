<?php

namespace App\Listeners;

use App\Events\LiquidacionEliminada;
use App\Models\GastoChofer;
use App\Models\LiquidacionGasto;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EliminarGastosListener
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
        $liquidacionGastos = LiquidacionGasto::where('liquidacion_id', $event->liquidacion_id)->get();
        foreach ($liquidacionGastos as $liquidacionGasto) {
            $gasto = GastoChofer::find($liquidacionGasto->gasto_id);
            if ($gasto) {
                $gasto->update([
                    'saldo' => $liquidacionGasto->importe,
                ]);
            }
            $liquidacionGasto->delete();
        }
    }
}
