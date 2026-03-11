<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'prenom',
        'email',
        'telephone',
        'ip_address',
        'pays',
        'ville',
        'password',
        'is_active',
        'last_login_at',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin(): bool
    {
        return $this->role?->slug === 'admin' || $this->role?->slug === 'superadmin';
    }

    public function isSuperAdmin(): bool
    {
        return $this->role?->slug === 'superadmin';
    }
    public function articles()
{
    return $this->hasMany(Article::class);
}

public function historiques()
{
    return $this->hasMany(Historique::class);
}
}