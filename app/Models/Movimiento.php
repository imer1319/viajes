<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_interno', 'fecha', 'cliente_id', 'tipo_viaje_id', 'detalle', 'numero_factura_1',
        'numero_factura_2', 'precio_real', 'iva', 'total', 'saldo_total', 'flota_id', 'chofer_id',
        'precio_chofer', 'porcentaje_pago', 'comision_chofer', 'saldo_comision_chofer',
    ];

    
}