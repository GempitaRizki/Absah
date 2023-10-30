<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IprCartItem extends Model
{
    use HasFactory;

    protected $table = 'ipr_cart_item';

    protected $primaryKey = 'id';

    protected $fillable = [
        'cart_id',
        'product_sku_id',
        'qty',
        'price', 
        'price_after_disc',
        'type_category',
        'check_cart_item',
        'shipping_cost',
    ];

    public function cart()
    {
        $this->belongsTo(IprCart::class, 'cart_id');
    }
    
    public function product()
    {
        $this->belongsTo(ProductSku::class, 'product_sku_id');
    }
}
