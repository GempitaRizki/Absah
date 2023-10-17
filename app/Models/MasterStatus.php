<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ppntag;

class MasterStatus extends Model
{
    use HasFactory;

    const IS_VISIBEL_TRUE = 1;
    const PRODUCT_TYPE = 20;
    const PRODUCT_CONDITION = 17;
    const PRODUCT_PRICE_TYPE = 23;

    const PRODUCT_SHIPPING_TYPE = 25;

    const PRODUCT_PPN = 21;

    const PRODUCT_SHIPPING = 22;

    const PRODUCT_PRODUSEN_TYPE = 26;
    const MADE_IN = 33; 

    const TYPE_CATEGORY = 32; 


    private static $_statuses =
    [

        self::PRODUCT_TYPE => 'Product Type',

        self::PRODUCT_CONDITION => 'Kondisi Produk',

        self::PRODUCT_PRICE_TYPE => 'Jenis Harga Produk', 

        self::PRODUCT_SHIPPING_TYPE => 'Product Shipping Type', 

        self::PRODUCT_PPN => 'Product PPn',

        self::PRODUCT_SHIPPING => 'Product Shipping',

        self::PRODUCT_PRODUSEN_TYPE => 'Produsen Type',

        self::MADE_IN => 'Made In',
        
        self::TYPE_CATEGORY => 'Tipe Kategori',


    ];

    protected $table = 'master_status';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'name_alias',
        'descriptions',
        'label_status',
        'is_status',
        'is_visible',
    ];

    public static function getListMasterProductType()
    {
        $listMasterProductType = MasterStatus::where('label_status', self::PRODUCT_TYPE)
            ->where('is_visible', self::IS_VISIBEL_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->all();

        return $listMasterProductType;
    }

    public static function getListMasterCondition()
    {
        $listMasterCondition = MasterStatus::where('label_status', self::PRODUCT_CONDITION)
            ->where('is_visible', self::IS_VISIBEL_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->all();

        return $listMasterCondition;
    }

    public static function getListPriceType()
    {
        $listPriceType = DB::table('master_status')
            ->where('label_status', self::PRODUCT_PRICE_TYPE)
            ->where('is_visible', self::IS_VISIBEL_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();

        return $listPriceType;
    }

    public static function getListShippingType()
    {
        $listShippingType = DB::table('master_status')
            ->where('label_status', self::PRODUCT_SHIPPING_TYPE)
            ->where('is_visible', self::IS_VISIBEL_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();

        return $listShippingType;
    }

    public static function getListPpn()
    {
        $listPpn = MasterStatus::where('label_status', SELF::PRODUCT_PPN)
            ->where('is_visible', SELF::IS_VISIBEL_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id');

        return $listPpn;
    }

    public static function getListShipping()
    {
        $listShipping = MasterStatus::where('label_status', SELF::PRODUCT_SHIPPING)
            ->where('is_visible', SELF::IS_VISIBEL_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();

        return $listShipping;
    }

    public static function getProductProdusenType()
    {
        $listProdusenType = MasterStatus::where('label_status', SELF::PRODUCT_PRODUSEN_TYPE)
            ->where('is_visible', SELF::IS_VISIBEL_TRUE)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();

        return $listProdusenType;
    }

    public static function getListPpnTag()
    {
        $listPpn = ppntag::where('jenis', 'item')
            ->orderBy('tag_id')
            ->get()
            ->map(function ($ppntag) {
                return ($ppntag->is_ppn == 1) ? '<b>' . $ppntag->name . '</b>' : '<b>Tidak BerPPN</b> - ' . $ppntag->name;
            })
            ->all();

        return $listPpn;
    }

    public static function getMadeInType()
    {
        $listMadeIn = MasterStatus::where('label_status', SELF::MADE_IN)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();

        return $listMadeIn;
    }
}
