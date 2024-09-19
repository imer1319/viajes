<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_interno',
        'fecha',
        'chofer_id',
        'total_liquidacion',
        'observaciones',
    ];

    public function movimientos()
    {
        return $this->hasMany(LiquidacionMovimiento::class);
    }

    public function gastos()
    {
        return $this->hasMany(LiquidacionGasto::class);
    }

    public function anticipos()
    {
        return $this->hasMany(LiquidacionAnticipo::class);
    }

    public function pagos()
    {
        return $this->hasMany(PagoLiquidacion::class);
    }

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

    public function scopeByFormaPagoId($query, $forma_id = null)
    {
        if ($forma_id) {
            return $query->whereHas('pagos', function ($q) use ($forma_id) {
                $q->where('forma_pago_id', $forma_id);
            });
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
