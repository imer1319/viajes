<?php

namespace App\Listeners;

use App\Events\LiquidacionEliminada;
use App\Models\AnticipoChofer;
use App\Models\LiquidacionAnticipo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EliminarAnticiposListener
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
        $liquidacionAnticipos = LiquidacionAnticipo::where('liquidacion_id', $liquidacion->id)->get();
        foreach ($liquidacionAnticipos as $liquidacionAnticipo) {
            $anticipo = AnticipoChofer::find($liquidacionAnticipo->anticipo_id);
            if ($anticipo) {
                $anticipo->update([
                    'saldo' => $liquidacionAnticipo->importe,
                ]);
            }
            $liquidacionAnticipo->delete();
        }
    }
}
