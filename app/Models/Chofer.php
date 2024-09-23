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
        return $this->hasMany(AnticipoChofer::class, 'chofer_id');
    }

    public function gastos()
    {
        return $this->hasMany(GastoChofer::class);
    }

    public function scopeBySaldo($query, $saldo = null)
    {
        if ($saldo === '1') {
            return $query->where('saldo', '!=', 0);
        } elseif ($saldo === '0') {
            return $query->where('saldo', '=', 0);
        }
        return $query;
    }
}
