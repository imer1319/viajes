<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoLiquidacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro',
        'liquidacion_id',
        'forma_pago_id',
        'banco_id',
        'importe',
        'fecha_emision',
        'fecha_vencimiento',
        'abreviacion',
        'descripcion'
    ];

    public function liquidacion()
    {
        return $this->belongsTo(Liquidacion::class, 'liquidacion_id');
    }
}
