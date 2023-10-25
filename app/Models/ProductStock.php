<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    const DEFAULT_STOCK = "10";
    const DEFAULT_LIMIT_STOCK = "3";
    protected $table = 'product_stock';

    protected $fillable = [
        'product_sku_id',
        'stock',
        'limit_stock',
    ];

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id');
    }

    public function getLimitStockAttribute($value)
    {
        return $value ?? self::DEFAULT_LIMIT_STOCK;
    }

    public static function minStock($skuId, $qty)
    {
        $productStock = self::where('product_sku_id', $skuId)->first();
        if ($productStock) {
            $newStock = $productStock->stock - $qty;
            if ($newStock < 0) {
                $newStock = 0;
            }
            $productStock->stock = $newStock;
            $productStock->save();
        }
    }
}
