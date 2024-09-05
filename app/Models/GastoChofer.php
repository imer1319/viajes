<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoChofer extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_interno',
        'fecha',
        'importe',
        'saldo',
        'flota_id',
        'chofer_id',
        'proveedor_id',
        'detalle',
    ];

    public function chofer()
    {
        return $this->belongsTo(Chofer::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function flota()
    {
        return $this->belongsTo(Flota::class);
    }

    public function tipoGastos()
    {
        return $this->belongsToMany(TipoGasto::class, 'chofer_tipo_gasto');
    }
}
