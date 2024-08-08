<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'razon_social',
        'cuit',
        'numero_ingreso_bruto',
        'condicion_iva_id',
        'domicilio',
        'telefono',
        'celular',
        'provincia_id',
        'localidad_id',
        'departamento_id',
        'codigo_postal',
        'email',
        'contacto',
        'retencion_ingreso_bruto_id',
        'cuenta_id',
        'retencion_ganancia_id',
        'plan_cuenta_id',
        'saldo',
        'estado'
    ];

    public function ordenCompras(): HasMany
    {
        return $this->hasMany(OrdenCompra::class);
    }

    public function condicionIva(): BelongsTo
    {
        return $this->belongsTo(CondicionIva::class);
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
}
