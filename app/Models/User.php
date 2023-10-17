<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_DELETED = 3;

    const ROLE_BUYER = 'buyer';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMINISTRATOR = 'administrator';
    const ROLE_OWNER_STORE = 'ownerStore';
    const ROLE_USER_STORE = 'userStore';

    const EVENT_AFTER_SIGNUP = 'afterSignup';
    const EVENT_AFTER_LOGIN = 'afterLogin';

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

    public function jumlahPenggunaByStatus($status)
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

    public function jumlahPenggunaSeller()
    {
        $userId = Auth::user()->id;
        $storeId = Store::getStoreIdByUserLogin();

        $query = User::where('status', self::STATUS_ACTIVE)
            ->join('store_user as su', 'su.user_id', '=', 'users.id')
            ->where('su.store_id', $storeId)
            ->count();

        return $query;
    }

    public function jumlahPenggunaSellerAktif()
    {
        $userId = Auth::user()->id;
        $storeId = Store::getStoreIdByUserLogin();

        $query = User::where('status', self::STATUS_ACTIVE)
            ->join('store_user as su', 'su.user_id', '=', 'users.id')
            ->where('su.store_id', $storeId)
            ->count();
        return $query;
    }

    public function jumlahPenggunaSellerTidakAktif()
    {
        $userId = Auth::user()->id;

        $storeId = Store::getStoreIdByUserLogin();

        $query = User::where('status', self::STATUS_NOT_ACTIVE)
            ->join('store_user as su', 'su.user_id', '=', 'users.id')
            ->where('su.store_id', $storeId)
            ->count();

        return $query;
    }

    public function storeUser()
    {
        return $this->hasMany(StoreUser::class, 'user_id');
    }
}
