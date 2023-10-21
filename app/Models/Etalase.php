<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Etalase extends Model
{

    const STATUS_ETALASE_ENABLE = '42';
    
    use HasFactory;

    protected $table = 'etalase';

    protected $fillable = [
        'name', 'parent_id', 'store_id', 'status_id'
    ];

    public static function getListEtalase()
    {
        $storeId = (new Store)->getStoreIdByUserLogin();
        $listEtalase = DB::table('etalase')
            ->select('id', 'name')
            ->where('status_id', self::STATUS_ETALASE_ENABLE)
            ->where('store_id', $storeId)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();

        return $listEtalase;
    }

    public static function emptyEtalse($productId)
    {
        DB::table('product_etalase')
            ->where('product_sku_id', $productId)
            ->delete();

        return true;
    }
}
