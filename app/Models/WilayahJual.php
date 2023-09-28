<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WilayahJual extends Model
{
    protected $table = 'wilayah_jual';

    protected $fillable = [
        'id',
        'kategori_product',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'districts_id');
    }

}


