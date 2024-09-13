<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaRecibo extends Model
{
    use HasFactory;

    protected $fillable = [
        'factura_id',
        'recibo_id',
        'pago',
    ];

    public function factura()
    {
        return $this->belongsTo(ClienteFactura::class);
    }
}
