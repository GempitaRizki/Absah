<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreOwner extends Model
{
    protected $table = 'store_owner';

    protected $fillable = [
        'name',
        'jabatan',
        'nik',
        'npwp',
        'phone_number',
        'store_id',
        'type',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'type');
    }
}
