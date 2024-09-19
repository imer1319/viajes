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

    public function scopeByChoferId($query, $chofer_id = null)
    {
        if ($chofer_id) {
            return $query->where('chofer_id', $chofer_id);
        }
        return $query;
    }

    public function scopeByFlotaId($query, $flota_id = null)
    {
        if ($flota_id) {
            return $query->where('flota_id', $flota_id);
        }
        return $query;
    }

    public function scopeBySaldo($query, $saldo = null)
    {
        if ($saldo === '1') {
            return $query->where('saldo', '!=', 0);
        } elseif ($saldo === '0') {
            return $query->where('saldo', '=', 0);
        }
        return $query;
    }
    
    public function scopeByDesde($query, $desde)
    {
        if ($desde) {
            return $query->where('fecha', '>=', $desde);
        }
        return $query;
    }

    public function scopeByHasta($query, $hasta)
    {
        if ($hasta) {
            return $query->where('fecha', '<=', $hasta);
        }
        return $query;
    }
}
