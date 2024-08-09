<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnticipoChofer extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_interno',
        'fecha',
        'chofer_id',
        'importe',
        'saldo',
    ];

    public function chofer()
    {
        return $this->belongsTo(Chofer::class);
    }
}
