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
    const IS_VISIBLE_TRUE = 1;
    const TYPE_CATEGORY = 32;
    const PRODUCT_TYPE = 20;
    const PRODUCT_CONDITION = 17;
    const PRODUCT_SHIPPING_TYPE = 25;
    const PRODUCT_PRICE_TYPE = 23;
    const PRODUCT_PPN = 21;
    const PRODUCT_SHIPPING = 22;
    const PRODUCT_PRODUSEN_TYPE = 26;
    const MADE_IN = 33; 




    private static $_statuses = [
        self::PRODUCT_TYPE => 'Product Type',
        self::PRODUCT_PRICE_TYPE => 'Jenis Harga Produk',
        self::PRODUCT_CONDITION => 'Kondisi Produk',
        self::PRODUCT_SHIPPING_TYPE => 'Product Shipping Type',
        self::TYPE_CATEGORY => 'Tipe Kategori',
        self::PRODUCT_PPN => 'Product PPn',
        self::PRODUCT_SHIPPING => 'Product Shipping',
        self::PRODUCT_SHIPPING_TYPE => 'Product Shipping Type',
        self::PRODUCT_PRODUSEN_TYPE => 'Produsen Type',
        self::MADE_IN => 'Made In',



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

    public static function getTypeFaktur()
    {
        $listFaktur = [
            151 => 'E-Faktur Approval',
            152 => 'Belum E-Faktur',
            153 => 'E-Faktur Batal',
            154 => 'E-Faktur Reject',
            155 => 'E-Faktur Belum Approve',
        ];

        return $listFaktur;
    }



    public static function getListPpn()
    {
        $listPpn = self::where('label_status', self::PRODUCT_PPN)
            ->where('is_visible', self::IS_VISIBLE_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id');

        return $listPpn->all();
    }

    public static function getListShipping()
    {
        $listShipping = MasterStatus::where('label_status', self::PRODUCT_SHIPPING)
            ->where('is_visible', self::IS_VISIBLE_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();
    
        return $listShipping;
    }
    

    public static function getProductProdusenType()
    {
        return self::where('label_status', self::PRODUCT_PRODUSEN_TYPE)
            ->where('is_visible', self::IS_VISIBLE_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();
    }

    public static function getMadeInType()
    {
        $listMadeIn = self::where('label_status', self::MADE_IN)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();

        return $listMadeIn;
    }
}
