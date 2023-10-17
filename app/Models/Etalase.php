<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etalase extends Model
{

    const STATUS_ETALASE_ENABLE = '42';
    
    use HasFactory;

    protected $table = 'etalase';

    protected $fillable = [
        'name', 'parent_id', 'store_id', 'status_id'
    ];

    // Jika Anda memiliki hubungan dengan model lain, tambahkan metode relasinya di sini.

    public static function getListEtalase()
    {
        $storeId = (new Store)->getStoreIdByUserLogin();

        $listEtalase = Etalase::where('status_id', SELF::STATUS_ETALASE_ENABLE)
            ->where('store_id', $storeId)
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();

        return $listEtalase;
    }
}
