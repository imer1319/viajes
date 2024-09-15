<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'placa',
        'marca',
        'anio',
        'kilometraje',
        'identificacion',
    ];

}
