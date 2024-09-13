<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoRecibo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro',
        'recibo_id',
        'forma_pago_id',
        'banco_id',
        'importe',
        'fecha_emision',
        'fecha_vencimiento'
    ];

    public function recibo()
    {
        return $this->belongsTo(Recibo::class, 'recibo_id');
    }
}
