<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignProductCat extends Model
{
    use HasFactory;

    protected $table = 'assign_product_cat';

    protected $fillable = [
        'category_id', 'parent', 'product_sku_id', 'category_agregasi',
        'sub_category_satu', 'sub_category_dua', 'sub_category_tiga',
        'sub_category_empat', 'sub_category_lima', 'sub_category_enam',
        'perbarui_kategori'
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id', 'id');
    }

    public static function getTotalProductPerCategory($category_id)
    {
        return AssignProductCat::where('category_id', $category_id)->count();
    }

    public function rules()
    {
        return array_replace_recursive(
            parent::rules(),
            [
                [['parent'], 'string'],
                [['category_id', 'product_sku_id', 'sub_category_satu', 'sub_category_dua', 'sub_category_tiga', 'sub_category_empat', 'sub_category_lima', 'sub_category_enam'], 'integer'],
                [['created_at', 'updated_at', 'category_agregasi', 'perbarui_kategori'], 'safe']
            ]
        );
    }
}
