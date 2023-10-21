<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStore extends Model
{
    protected $table = 'product_store';

    protected $fillable = [
        'store_id',
        'product_sku_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id');
    }

    public static function listStoreByLogin()
    {
        $storeId = Store::getStoreIdByUserLogin();
    
        $listStoreAll = Store::where('id', $storeId)
            ->orderBy('id')
            ->pluck('store_name', 'id')
            ->toArray();
    
        return $listStoreAll;
    }
}
