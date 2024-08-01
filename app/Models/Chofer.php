<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'fecha_nacimiento',
        'cuil',
        'dni',
        'domicilio',
        'email',
        'telefono',
        'saldo'
    ];
}
