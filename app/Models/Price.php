<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'zona_id'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($price) {
            if ($price->isDirty('price')) {
                $price->product->update(['price' => $price->price]);
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
