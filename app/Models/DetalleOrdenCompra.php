<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleOrdenCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'orden_compra_id',
        'precio_compra',
        'cantidad',
        'cantidad_pendiente',
        'cantidad_baja',
        'subtotal',
        'subtotal_impuestos'
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
    




}
