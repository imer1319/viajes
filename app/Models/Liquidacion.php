<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_interno',
        'fecha',
        'chofer_id',
        'total_liquidacion',
        'observaciones',
    ];

    public function movimientos()
    {
        return $this->hasMany(LiquidacionMovimiento::class);
    }

    public function gastos()
    {
        return $this->hasMany(LiquidacionGasto::class);
    }

    public function anticipos()
    {
        return $this->hasMany(LiquidacionAnticipo::class);
    }

    public function chofer()
    {
        return $this->belongsTo(Chofer::class);
    }
}
