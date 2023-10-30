<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierPartner extends Model
{
    use HasFactory;

    protected $table = 'courier_partner';
    protected  $filllable = [
        'name', 'address', 'phone_number' , 'email', 'code' , 'province_id' , 'districts_id', 'subdistrict_id' , 'village_id' , 'aktif'
    ];
}
