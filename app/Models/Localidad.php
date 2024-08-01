<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Localidad extends Model
{
    use HasFactory;

    protected $table = 'localidades';

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }
}
