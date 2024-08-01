<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetencionIngresosBruto extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion','porcentaje'];

    public function setDescripcionAttribute($value)
    {
        $this->attributes['descripcion'] = strtoupper($value);
    }
}
