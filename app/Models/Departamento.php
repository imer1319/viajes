<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    use HasFactory;

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }

    public function localidades(): HasMany
    {
        return $this->hasMany(Localidad::class);
    }
}
