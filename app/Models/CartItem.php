<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id',
        'product_sku_id',
        'qty',
        'price',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
