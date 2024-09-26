<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'razon_social',
        'domicilio',
        'cuit',
        'numero_ingreso_bruto',
        'condicion_iva_id',
        'telefono',
        'celular',
        'provincia_id',
        'departamento_id',
        'localidad_id',
        'codigo_postal',
        'email',
        'contacto',
        'retencion_ganancia_id',
        'retencion_ingreso_bruto_id',
        'tipo_documento_id',
        'numero_documento',
        'estado',
        'saldo'
    ];

    public function condicionIva(): BelongsTo
    {
        return $this->belongsTo(CondicionIva::class);
    }
    public function tipoDocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class);
    }

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    public function localidad(): BelongsTo
    {
        return $this->belongsTo(Localidad::class);
    }

    public function retencionIngresoBruto(): BelongsTo
    {
        return $this->belongsTo(RetencionIngresosBruto::class);
    }

    public function planCuenta(): BelongsTo
    {
        return $this->belongsTo(PlanCuenta::class);
    }

    public function retencionGanancia(): BelongsTo
    {
        return $this->belongsTo(RetencionGanancia::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    public function facturas()
    {
        return $this->hasMany(ClienteFactura::class);
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
}
