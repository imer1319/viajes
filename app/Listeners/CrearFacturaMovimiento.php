<?php

namespace App\Listeners;

use App\Events\MovimientoCreado;
use App\Models\FacturaMovimiento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CrearFacturaMovimiento
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
        $movimiento = $event->movimiento;
        FacturaMovimiento::create([
            'fecha' => now(),
            'detalle' => 'Detalles de la factura',
            'iva' => $movimiento->iva,
            'neto' => $movimiento->total,
            'total' => $movimiento->total,
            'saldo_total' => $movimiento->saldo_total,
            'numero_factura_1' => '001',
            'numero_factura_2' => '00000001',
            'movimiento_id' => $movimiento->id,
            'cliente_id' => $movimiento->cliente_id,
            'tipo_viaje_id' => $movimiento->tipo_viaje_id,
            'chofer_id' => $movimiento->chofer_id,
            'flota_id' => $movimiento->flota_id,
        ]);
    }
}
