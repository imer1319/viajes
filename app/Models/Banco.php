<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'domicilio',
        'saldo',
        'numero_cuenta',
        'cbu',
        'alias',
    ];

    public function setDescripcionAttribute($value)
    {
        $this->attributes['descripcion'] = strtoupper($value);
    }

    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = strtoupper($value);
    }
}
