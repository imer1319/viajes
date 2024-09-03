<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $fillable = [
        'factura_id',
        'movimiento_id',
    ];

    public function factura()
    {
        return $this->belongsTo(ClienteFactura::class);
    }

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }
}
