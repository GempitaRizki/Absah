<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
		'first_name', 'last_name', 'email', 'phone', 'password', 'company', 'address1', 'address2', 'province_id', 'city_id', 'postcode',
	];

	protected $hidden = [
		'password', 'remember_token',
	];


	protected $casts = [
		'email_verified_at' => 'datetime',
	];


	public function products()
	{
		return $this->hasMany('App\Models\Product');
	}


	public function favorites()
	{
		return $this->hasMany('App\Models\Favorite');
	}
}