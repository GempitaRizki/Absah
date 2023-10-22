<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'hierarchy',
        'hierarchy_name',
        'level',
        'status_id',
        'logo',
        'bash_logo',
        'descriptions',
        'type_category',
        'dikbud_type',
        'urut',
        'dikbud',
        'kat_agregasi',
    ];


    public static function getListHierarchySelected($id)
    {
        $productCategory = ProductCategory::find($id);

        $listHierarchy = [];

        if ($productCategory) {
            $explodeHierarchy = explode('-', $productCategory->hierarchy);
            if ($explodeHierarchy) {
                $dataArr = [];
                foreach ($explodeHierarchy as $value) {
                    $dataDetail = ProductCategory::find($value);
                    if ($dataDetail) {
                        $dataArr[] = $dataDetail->name;
                    }
                }

                $listHierarchy[$productCategory->id] = implode(' > ', $dataArr);
            } else {
                $listHierarchy[$productCategory->id] = $productCategory->name;
            }
        }

        return $listHierarchy;
    }
}

