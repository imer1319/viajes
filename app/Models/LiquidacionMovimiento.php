<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidacionMovimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'importe',
        'chofer_id',
        'movimiento_id',
        'liquidacion_id',
    ];

    public function liquidacion()
    {
        return $this->belongsTo(Liquidacion::class);
    }

    public function chofer()
    {
        return $this->belongsTo(Chofer::class);
    }

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }
}
