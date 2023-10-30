<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourierProduct extends Model
{
    protected $table = 'courier_product';
    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'name',
        'status_id',
        'courier_partner_id',
        'service',
    ];

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'status_id');
    }

    public function courierPartner()
    {
        return $this->belongsTo(CourierPartner::class, 'courier_partner_id');
    }
}

