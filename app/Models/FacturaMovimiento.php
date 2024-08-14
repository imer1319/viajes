<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaMovimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'detalle',
        'iva',
        'neto',
        'total',
        'saldo_total',
        'numero_factura_1',
        'numero_factura_2',
        'cliente_id',
        'tipo_viaje_id',
        'movimiento_id',
        'chofer_id',
        'flota_id',
    ];
}
