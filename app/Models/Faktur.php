<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
    protected $table = 'faktur';

    protected $fillable = [
        'store_id',
        'no_faktur',
        'status',
        'startdate',
        'enddate',
        'order_id',
        'status_faktur',
        'dpp',
        'ppn',
        'tanggal',
        'kode_faktur',
        'npwp',
        'alamat',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
