<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidacionGasto extends Model
{
    use HasFactory;

    protected $fillable = [
        'chofer_id',
        'liquidacion_id',
        'gasto_id',
        'importe',
    ];

    public function liquidacion()
    {
        return $this->belongsTo(Liquidacion::class);
    }

    public function chofer()
    {
        return $this->belongsTo(Chofer::class);
    }
}
