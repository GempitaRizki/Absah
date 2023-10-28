<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderBast extends Model
{
    protected $table = 'order_bast';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nomor_bast',
        'order_id',
        'qty',
        'qty_sesuai',
        'qty_tidak_sesuai',
        'qty_rusak',
        'product_sku_id',
        'catatan',
        'sudah_bast',
        'ke',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id', 'id');
    }

}
