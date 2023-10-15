<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    const ROLE_USER = 0;
    const ROLE_SELLER = 1;
    const ROLE_MITRA = 2;
    const ROLE_ADMIN = 3;
    const ROLE_OWNER_STORE = 'owner_store';
    const ROLE_USER_STORE = 'user_store';

    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'username', 'role', 'email', 'password', 'phone', 'jabatan', 'NIP', 'NIK',
    ];

    protected $hidden = [
        'id_login',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models.Favorite');
    }

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["user", "seller", "mitra", "admin"][$value],
        );
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
}