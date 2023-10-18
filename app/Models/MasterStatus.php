<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterStatus extends Model
{
    use HasFactory;

    protected $table = 'master_status';

    protected $fillable = [
        'name',
        'name_alias',
        'descriptions',
        'label_status',
        'is_status',
        'is_visible',
    ];
    const TYPE_CATEGORY = 32; 

    const PRODUCT_TYPE = 20;
    const PRODUCT_CONDITION = 17;

    const PRODUCT_SHIPPING_TYPE = 25;

    const IS_VISIBLE_TRUE = 1;
    const PRODUCT_PRICE_TYPE = 23;



    private static $_statuses = [
        self::PRODUCT_TYPE => 'Product Type',
        self::PRODUCT_PRICE_TYPE => 'Jenis Harga Produk',
        self::PRODUCT_CONDITION => 'Kondisi Produk',
        self::PRODUCT_SHIPPING_TYPE => 'Product Shipping Type',
        self::TYPE_CATEGORY => 'Tipe Kategori',


    ];

    public static function getListMasterProductType()
    {
        $listMasterProductType = self::where('label_status', self::PRODUCT_TYPE)
            ->where('is_visible', self::IS_VISIBLE_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->all();


        return $listMasterProductType;
    }

    public static function getListPriceType()
    {
        $listPriceType = self::where('label_status', self::PRODUCT_PRICE_TYPE)
            ->where('is_visible', self::IS_VISIBLE_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->all();

        return $listPriceType;
    }

    public static function getListMasterCondition()
    {
        $listMasterCondition = self::where('label_status', self::PRODUCT_CONDITION)
            ->where('is_visible', self::IS_VISIBLE_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->all();

        return $listMasterCondition;
    }


}