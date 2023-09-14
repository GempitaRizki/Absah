<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable, HasRoles;

	
    protected $fillable = [
		'name', 'email', 'password', 'phone', 'jabatan', 'NIP', 'NIK',
	];

	protected $hidden = [
		'id_login',
	];

	// protected $attributes = [
	// 	'id_login' => 0,
	// ];

	protected $casts = [
		'email_verified_at' => 'datetime',
		'password' =>'hashed'
	];

	public function products()
	{
		return $this->hasMany('App\Models\Product');
	}


	public function favorites()
	{
		return $this->hasMany('App\Models\Favorite');
	}

	protected function role(): Attribute
	{
		return new Attribute(
			get: fn($value) => ["user", "seller", "mitra", "admin"][$value],
		);
	}
}