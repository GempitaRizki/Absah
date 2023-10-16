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
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_DELETED = 3;
    const ROLE_USER = 0;
    const ROLE_SELLER = 1;
    const ROLE_MITRA = 2;
    const ROLE_ADMIN = 3;
    const ROLE_OWNER_STORE = 'owner_store';
    const ROLE_USER_STORE = 'user_store';

    use HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'username', 'role', 'email', 'password', 'phone', 'jabatan', 'NIP', 'NIK',
    ];

    protected $hidden = [
        'id_login',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function totalPengguna()
    {
        $users = $this->getUsersByStore();
        return $users->count();
    }

    public function totalPenggunaAktif()
    {
        return $this->getUsersCountByStatus(self::STATUS_ACTIVE);
    }

    public function totalPenggunaBeku()
    {
        return $this->getUsersCountByStatus(self::STATUS_NOT_ACTIVE);
    }

    public function statuses()
    {
        return [
            self::STATUS_NOT_ACTIVE => 'Not Active',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DELETED => 'Deleted',
        ];
    }

    public function storeDetail()
    {
        return $this->hasOne(StoreDetail::class, 'store_id', 'id');
    }

    protected function getUsersByStore()
    {
        $storeDetail = $this->storeDetail;

        if ($storeDetail) {
            return UserSekolah::where('sekolah_id', $storeDetail->store_id)->get();
        }

        return collect();
    }

    protected function getUsersCountByStatus($status)
    {
        $storeDetail = $this->storeDetail;

        if ($storeDetail) {
            $store_id = $storeDetail->store_id;
            return UserSekolah::where('sekolah_id', $store_id)
                ->join('users', 'user_sekolah.user_id', '=', 'users.id')
                ->where('users.status', $status)
                ->distinct()
                ->count();
        }

        return 0;
    }
}
