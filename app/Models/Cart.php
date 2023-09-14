<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'id',
        'store_id',
        'product_id',
        'price',
        'quantity',
        'name',
        'total_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
