<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_interno',
        'fecha',
        'cliente_id',
        'tipo_viaje_id',
        'detalle',
        'numero_factura_1',
        'numero_factura_2',
        'precio_real',
        'iva',
        'total',
        'saldo_total',
        'flota_id',
        'chofer_id',
        'precio_chofer',
        'porcentaje_pago',
        'comision_chofer',
        'saldo_comision_chofer',
        'facturado'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tipoViaje()
    {
        return $this->belongsTo(TipoViaje::class);
    }

    public function facturas()
    {
        return $this->belongsToMany(ClienteFactura::class, 'detalle_facturas', 'movimiento_id', 'factura_id');
    }
    
    public function flota()
    {
        return $this->belongsTo(Flota::class);
    }

    public function chofer()
    {
        return $this->belongsTo(Chofer::class);
    }

    public function scopeByChoferId($query, $choferId = null)
    {
        if ($choferId) {
            return $query->where('chofer_id', $choferId);
        }
        return $query;
    }

    public function scopeByTipoViajeId($query, $tipo_viaje_id = null)
    {
        if ($tipo_viaje_id) {
            return $query->where('tipo_viaje_id', $tipo_viaje_id);
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

    public function scopeByClienteId($query, $cliente_id = null)
    {
        if ($cliente_id) {
            return $query->where('cliente_id', $cliente_id);
        }
        return $query;
    }

    public function scopeByFacturado($query, $facturado = null)
    {
        if ($facturado === '1' || $facturado === '0') {
            return $query->where('facturado', $facturado);
        }
        return $query;
    }
}
