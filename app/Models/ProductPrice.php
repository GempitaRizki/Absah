<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{

    const ZONA_1 = 'zona1';
    const ZONA_2 = 'zona2';
    const ZONA_3 = 'zona3';
    const ZONA_4 = 'zona4';
    const ZONA_5 = 'zona5';

    const ZONA_1_VALUE = '1';
    const ZONA_2_VALUE = '2';
    const ZONA_3_VALUE = '3';
    const ZONA_4_VALUE = '4';
    const ZONA_5_VALUE = '5';


    const SCENARIO_PRICE_ZONASI = 'PRICE_ZONASI';
    const SCENARIO_PRICE_NASIONAL = 'PRICE_NASIONAL';
    const SCENARIO_PRICE_GROSIR = 'PRICE_GROSIR';
    const SCENARIO_PRICE_GROSIR_ON_VARIANT = 'PRICE_GROSIR_ON_VARIANT';

    use HasFactory;

    protected $table = 'product_price';

    protected $fillable = [
        'price',
        'zona',
        'qty',
        'product_sku_id',
        'price_after_discount',
        'price_after_discount_type',
        'data_array',
        'qty_min',
        'qty_max',
    ];

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id' , 'id');
    }

    public static function productPriceZonaDetail($zona, $productSkuId)
    {
        return self::where('zona', $zona)
            ->where('product_sku_id', $productSkuId)
            ->first();
    }
}
