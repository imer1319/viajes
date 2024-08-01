<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'proveedor_id',
        'condiciones_pagos_id',
        'descripcion',
        'neto',
        'iva',
        'fecha',
        'total',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'datetime'
    ];

    public function detalleOrdenCompra(): HasMany
    {
        return $this->hasMany(DetalleOrdenCompra::class);
    }

    public function proveedor() : BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function condicionesPago(): BelongsTo
    {
        return $this->belongsTo(CondicionesPago::class, 'condiciones_pagos_id');
    }
}
