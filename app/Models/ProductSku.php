<?php

namespace App\Models;

use App\TypeOngkir;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductSku extends Model
{
    protected $table = 'product_sku';

    protected $fillable = [
        'product_id',
        'product_id_reference',
        'sku',
        'key_attribute',
        'key_sku',
        'name',
        'jenjang',
        'tipe_produk',
        'slug',
        'weight',
        'weight_packing',
        'unit_weight',
        'has_ppn',
        'detail_ppn',
        'tag_ppn',
        'has_shipping',
        'produsen_type',
        'descriptions',
        'url_video',
        'length',
        'width',
        'height',
        'preorder_estimate',
        'preorder',
        'created_by',
        'status_id',
        'attribute_value',
        'value_ppn',
        'type_ppn',
        'tags',
        'garansi',
        'brand',
        'cetakan',
        'nomor_sk',
        'tgl_sk',
        'code_kbki',
        'made_in',
        'min_qty',
        'unique_id',
        'agregasi_status',
        'kat_produk',


    ];
    const DEFAULT_HAS_PPN = '33';
    const DEFAULT_HAS_SHIPPING = '35';
    const DEFAULT_STATUS_ID = '46';
    const DEFAULT_PREORDER = '27';
    const DEFAULT_WEIGHT = '0';
    const DEFAULT_UNIT_WEIGHT = '28';
    const DEFAULT_PRODUSEN_TYPE = '55';

    const ENABLE_STATUS_ID = '44';
    const DISABLE_STATUS_ID = '45';
    const PENDING_REVIEW_STATUS_ID = '47';
    const HAPUS = '120';
    const DISABLE_MITRA = '138';
    const BARU = '139';
    const DRAFT = '46';

    const BER_PPN = '33';
    const TIDAK_PPN = '34';
    const BEBAS_PPN = '54';

    const SCENARIO_CREATE = 'SCRENARIO_CREATE';
    const SCENARIO_UPDATE = 'SCENARIO_UPDATE';


    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function product()
    {
        return $this->belongsTo(MasterStatus::class, 'product_id');
    }

    public function unitWeight()
    {
        return $this->belongsTo(MasterStatus::class, 'unit_weight');
    }

    public function hasPpnStatus()
    {
        return $this->belongsTo(MasterStatus::class, 'has_ppn');
    }

    public function hasShippingStatus()
    {
        return $this->belongsTo(MasterStatus::class, 'has_shipping');
    }

    public function preorderStatus()
    {
        return $this->belongsTo(MasterStatus::class, 'preorder');
    }

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'status_id');
    }

    public static function getWilayahJual()
    {
        $storeId = Store::getStoreIdByUserLogin();

        $listWilayahJual = WilayahJual::where('store_id', $storeId)
            ->orderBy('kategori_product')
            ->groupBy('kategori_product')
            ->pluck('kategori_product')
            ->toArray();

        return $listWilayahJual;
    }
}
