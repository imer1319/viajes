<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormasPagos extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'abreviacion'];

    public function setDescripcionAttribute($value)
    {
        $this->attributes['descripcion'] = strtoupper($value);
    }

    public function setAbreviacionAttribute($value)
    {
        $this->attributes['abreviacion'] = strtoupper($value);
    }
}
