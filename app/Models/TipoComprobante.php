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

    public function liquidacion(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->liquida_iva ? 'Si' :'No'
        );
    }

    public function emicion(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->emite ? 'Si':'No'
        );
    }

    public function recepcion(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->recibe ? 'Si':'No'
        );
    }
}
