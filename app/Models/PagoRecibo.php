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
        'fecha_vencimiento',
        'abreviacion',
        'descripcion'
    ];

    public function recibo()
    {
        return $this->belongsTo(Recibo::class, 'recibo_id');
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }

    public function forma()
    {
        return $this->belongsTo(FormasPagos::class, 'forma_pago_id');
    }
}
