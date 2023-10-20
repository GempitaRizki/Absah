<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEtalase extends Model
{
    use HasFactory;
    protected $table = "product_etalase";

    protected $primaryKey = 'id';

    protected $fillable = [
        'etalase_id',
        'product_sku_id',
    ];

    public function etalase()
    {
        return $this->belongsTo(Etalase::class, 'etalase_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id');
    }
}
