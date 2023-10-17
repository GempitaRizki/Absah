<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterStatus extends Model
{
    use HasFactory;

    const IS_VISIBEL_TRUE = 1;
    const PRODUCT_TYPE = 20;
    const PRODUCT_CONDITION = 17;
    const PRODUCT_PRICE_TYPE = 23;  

    const PRODUCT_SHIPPING_TYPE = 25;

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
}
