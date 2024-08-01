<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'provincia_id',
        'localidad_id',
        'codigo_postal',
        'email',
        'retencion_ingresos_id',
        'cuenta_id',
        'retencion_ganancias_id',
        'saldo',
        'estado'
    ];

    public function ordenCompras(): HasMany
    {
        return $this->hasMany(OrdenCompra::class);
    }
}
