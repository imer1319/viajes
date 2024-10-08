<?php

namespace App\Listeners;

use App\Events\LiquidacionCreada;
use App\Models\GastoChofer;
use App\Models\LiquidacionGasto;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GuardarGastosListener
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
        $liquidacion = $event->liquidacion;
        foreach (request()->input('gastos', []) as $gasto) {
            LiquidacionGasto::create([
                'chofer_id' => $liquidacion->chofer_id,
                'gasto_id' => $gasto['id'],
                'importe' => $gasto['importe'],
                'liquidacion_id' => $liquidacion->id,
            ]);
            $gas = GastoChofer::find($gasto["id"]);
            $gas->update([
                'saldo' => 0
            ]);
        }
    }
}
