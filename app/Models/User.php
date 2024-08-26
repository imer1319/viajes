<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'has_profile_photo',
        'profile_photo',
    ];

    public function hasProfilePhoto(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->profile_photo_path !== config('custom.profile_default.nombre')
        );
    }

    public function profilePhoto(): Attribute
    {
        return Attribute::make(
            get: fn () => !$this->has_profile_photo
                ? asset("/images/users/{$this->profile_photo_path}")
                : Storage::disk('profiles')->url($this->profile_photo_path),
        );
    }
    public function scopeMainSearch(Builder $query, Collection $data): Builder
    {
        if ($data->get('name')) {
            $query->where('name', 'like', "%{$data->get('name')}%");
        }
        
        return $query;
    }

    public function getRoleDisplayNames()
    {
        return $this->roles->pluck('description')->implode(', ');
    }
}
