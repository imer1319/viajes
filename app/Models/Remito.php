<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Remito extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numero',
        'proveedor_id',
        'localidad_id',
        'fecha_ingreso',
        'estado'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function ordenCompras()
    {
        return $this->belongsToMany(OrdenCompra::class);
    }

    public function detalleRemito(): HasMany
    {
        return $this->hasMany(DetalleRemito::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
