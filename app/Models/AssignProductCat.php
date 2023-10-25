<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignProductCat extends Model
{
    protected $table = 'assign_product_cat';

    protected $fillable = [
        'category_id',
        'parent',
        'product_sku',
        'product_sku_id',
        'category_agregasi',
    ];

    public function Category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }


    public function productSku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku', 'product_id');
    }
    
}
