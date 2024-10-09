<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoViaje extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion'];

    public function setDescripcionAttribute($value)
    {
        $this->attributes['descripcion'] = strtoupper($value);
    }


    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    public function scopeWithMostMovimientos($query, $desde = null, $hasta = null)
    {
        return $query->whereHas('movimientos', function ($query) use ($desde, $hasta) {
            if ($desde) {
                $query->whereDate('fecha', '>=', $desde);
            }
            if ($hasta) {
                $query->whereDate('fecha', '<=', $hasta);
            }
        })
            ->withCount(['movimientos' => function ($query) use ($desde, $hasta) {
                if ($desde) {
                    $query->whereDate('fecha', '>=', $desde);
                }
                if ($hasta) {
                    $query->whereDate('fecha', '<=', $hasta);
                }
            }])
            ->orderBy('movimientos_count', 'desc');
    }
}
