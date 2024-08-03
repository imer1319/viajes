<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CondicionesPago extends Model
{
    use HasFactory;

    protected $fillable = ['condicion', 'dias'];

    public function setCondicionAttribute($value)
    {
        $this->attributes['condicion'] = strtoupper($value);
    }
}
