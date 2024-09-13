<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_interno',
        'cliente_id',
        'fecha',
        'observaciones',
        'total_recibo',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pagos()
    {
        return $this->hasMany(PagoRecibo::class, 'recibo_id');
    }

    public function facturas()
    {
        return $this->hasMany(FacturaRecibo::class, 'recibo_id');
    }
}
