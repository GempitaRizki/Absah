<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Districts;

class WilayahJual extends Model
{
    protected $table = 'wilayah_jual';

    protected $fillable = [
        'districts_id',
        'kategori_product',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function district()
    {
        return $this->belongsTo(Districts::class, 'districts_id');
    }
}
