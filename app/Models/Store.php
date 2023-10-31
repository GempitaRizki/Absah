<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\StoreUser;
use Illuminate\Support\Facades\DB;


class Store extends Model
{
    use HasFactory;
    protected $table = 'stores';
    protected $primaryKey = 'id';

    protected $fillable = [
        'store_type',
        'store_name',
        'province_id',
        'district_id',
        'subdistrict_id',
        'village_id',
        'address',
        'postal_code',
        'phone_number',
        'public_email',
        'slug',
        'short_description',
        'about_us',
        'fb_name',
        'tw_name',
        'yt_name',
        'linked_name',
        'web_name',
        'status_id',
        'seller_type',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(Districts::class, 'district_id');
    }

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class, 'subdistrict_id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'status_id');
    }

    public function sellerType()
    {
        return $this->belongsTo(MasterStatus::class, 'seller_type', 'name');
    }

    public static function getStoreIdByUserLogin()
    {
        $user = Auth::user();

        if ($user) {
            $storeUser = StoreUser::join('rbac_auth_assignment as raa', 'store_users.user_id', '=', 'raa.user_id')
                ->whereIn('raa.item_name', [User::ROLE_OWNER_STORE, User::ROLE_USER_STORE])
                ->where('store_users.user_id', $user->id)
                ->first();

            if ($storeUser) {
                return $storeUser->store_id;
            }
        }

        return null;
    }

    public function cart()
    {
        return $this->hasMany(IprCart::class, 'store_id');
    }
}
