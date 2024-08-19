<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidacionAnticipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'chofer_id',
        'anticipo_id',
        'liquidacion_id',
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

    public function anticipo()
    {
        return $this->belongsTo(AnticipoChofer::class);
    }
}
