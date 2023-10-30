<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_address';

    protected $fillable = [
        'label',
        'province_id',
        'districts_id',
        'subdistrict_id',
        'village_id',
        'village_name',
        'address',
        'phone_number',
        'user_id',
        'status_id',
        'sekolah_id',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function districts()
    {
        return $this->belongsTo(Districts::class, 'districts_id');
    }

    public function subdistrict()
    {
        return $this->belongsTo(Subdistricts::class, 'subdistrict_id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'status_id');
    }
}
