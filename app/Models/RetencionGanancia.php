<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetencionGanancia extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'tipo',
        'minimo',
        'alicuota',
        'codigo_retencion',
        'codigo_afip',
    ];

    public function setCodigoAttribute($value)
    {
        $this->attributes['codigo'] = strtoupper($value);
    }

    public function setTipoAttribute($value)
    {
        $this->attributes['tipo'] = strtoupper($value);
    }
}
