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

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    public function anticipos()
    {
        return $this->hasMany(AnticipoChofer::class);
    }

    public function gastos()
    {
        // return $this->hasMany(Gastos::class);
    }
}
