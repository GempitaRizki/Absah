<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';

    protected $fillable = [
        'name', 'slug', 'parent_id', 'hierarchy', 'hierarchy_name', 'level', 'status_id',
        'logo', 'bash_logo', 'descriptions', 'type_category', 'dikbud_type',
        'urut', 'dikbud', 'kat_agregasi'
    ];

    public static function getListHirarchySelected($id)
    {
        $productCategory = ProductCategory::where('id', $id)->get();
    
        $listHierarchy = [];
        foreach ($productCategory as $category) {
            $explodeHierarchy = explode('-', $category->hierarchy);
            if ($explodeHierarchy !== false) {
                $dataArr = [];
                foreach ($explodeHierarchy as $value) {
                    $dataDetail = ProductCategory::where('id', $value)->first();
                    $dataArr[] = $dataDetail->name;
                }
    
                $listHierarchy[$category->id] = implode(' > ', $dataArr);
            } else {
                $listHierarchy[$category->id] = $category->name;
            }
        }
    
        return $listHierarchy;
    }

}
