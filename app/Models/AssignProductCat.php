<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignProductCat extends Model
{
    protected $table = 'assign_product_cat';

    protected $fillable = [
        'category_id',
        'product_sku_id',
        'sub_category_satu',
        'sub_category_dua',
        'sub_category_tiga',
        'sub_category_empat',
        'sub_category_lima',
        'sub_category_enam',
        'category_agregasi',
        'perbarui_kategori',
    ];

    public function productSku()
    {
        return $this->belongsTo(ProductSKU::class, 'product_sku_id');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function getTotalProductPerCategory($category_id)
    {
        return $this->where('category_id', $category_id)->count();
    }

    public function rules()
    {
        return [
            'category_id' => 'required',
            'parent' => 'string',
            'sub_category_satu' => 'integer',
            'sub_category_dua' => 'integer',
            'sub_category_tiga' => 'integer',
            'sub_category_empat' => 'integer',
            'sub_category_lima' => 'integer',
            'sub_category_enam' => 'integer',
            'created_at' => 'date',
            'updated_at' => 'date',
            'category_agregasi' => 'date',
            'perbarui_kategori' => 'date',
        ];
    }
}
