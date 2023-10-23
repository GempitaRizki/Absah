<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBuddle extends Model
{
    use HasFactory;

    protected $table = 'product_buddle';
    protected $fillable = [
        'min_qty', 'bundle_id', 'product_sku_id', 'is_edit_qty', 'is_delete', 'is_hide'
    ];

    public function budle()
    {
        return $this->belongsTo(ProductSku::class, 'bundle_id');
    }

    public function ProductSku()
    {
        return $this->belongsTo(ProductSku::class. 'product_sku_id');
    }
}
