<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteFactura extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'cliente_id',
        'neto',
        'iva',
        'total',
        'saldo_total',
        'observaciones',
        'numero_factura_1',
        'numero_factura_2',
        'condiciones_pago_id',
        'numero_interno',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'factura_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function condicionPago()
    {
        return $this->belongsTo(CondicionesPago::class);
    }

    public function scopeByClienteId($query, $cliente_id = null)
    {
        if ($cliente_id) {
            return $query->where('cliente_id', $cliente_id);
        }
        return $query;
    }
    
    public function scopeBySaldo($query, $saldo = null)
    {
        if ($saldo === '1') {
            return $query->where('saldo_total', '!=', 0);
        } elseif ($saldo === '0') {
            return $query->where('saldo_total', '=', 0);
        }
        return $query;
    }
    
}
