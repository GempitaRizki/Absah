<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    protected $table = 'product_tag';

    protected $fillable = [
        'ord', 'product_sku_id', 'tag_id'
    ];

    public static function getListTagOnProduct($productSkuId)
    {
        $model = ProductTag::where('product_sku_id', $productSkuId)->get();

        $data = [];
        foreach ($model as $item) {
            $data[] = $item->tag_id;
        }

        return $data;
    }
}
