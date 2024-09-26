<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TipoComprobante extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'descripcion',
        'liquida_iva',
        'emite',
        'recibe',
    ];
   
    protected $appends = [
        'liquidacion',
        'emicion',
        'recepcion'
    ];

    public function setDescripcionAttribute($value)
    {
        $this->attributes['descripcion'] = strtoupper($value);
    }
    
    public function setCodigoAttribute($value)
    {
        $this->attributes['codigo'] = strtoupper($value);
    }

    public function getLiquidacionAttribute()
    {
        return $this->liquida_iva ? 'Si' : 'No';
    }

    public function getEmicionAttribute()
    {
        return $this->emite ? 'Si' : 'No';
    }

    public function getRecepcionAttribute()
    {
        return $this->recibe ? 'Si' : 'No';
    }
}
