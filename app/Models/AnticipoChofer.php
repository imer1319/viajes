<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnticipoChofer extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_interno',
        'fecha',
        'chofer_id',
        'importe',
        'saldo',
    ];

    public function chofer()
    {
        return $this->belongsTo(Chofer::class);
    }

    public function scopeByChoferId($query, $chofer_id = null)
    {
        if ($chofer_id) {
            return $query->where('chofer_id', $chofer_id);
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
