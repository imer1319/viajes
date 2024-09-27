<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoGasto extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion'];

    public function gastos()
    {
        return $this->belongsToMany(GastoChofer::class, 'chofer_tipo_gasto');
    }

    public function setDescripcionAttribute($value)
    {
        $this->attributes['descripcion'] = strtoupper($value);
    }
}
