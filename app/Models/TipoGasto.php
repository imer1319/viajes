<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoGasto extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion'];

    public function gastoChofer()
    {
        return $this->belongsToMany(GastoChofer::class, 'chofer_tipo_gasto');
    }
}
