<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFile extends Model
{

    const MAX_FILE_IMAGE_PRODUCT_UPLOAD = 5;

    use HasFactory;

    protected $table = 'product_file';

    protected $fillable = [
        'path',
        'path_bashurl',
        'product_sku_id',
    ];

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id');
    }
}
