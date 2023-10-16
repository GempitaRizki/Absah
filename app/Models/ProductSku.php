<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    const HAPUS = 0;
    const ENABLE_STATUS_ID = 1;

    const PENDING_REVIEW_STATUS_ID = 2;

    const DRAFT = 3;

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

    public static function getTotalProduct($type)
    {
        $storeId = Store::getStoreIdByUserLogin();

        return self::join('product_store as pstore', 'pstore.product_sku_id', '=', 'product_sku.id')
            ->where('pstore.store_id', $storeId)
            ->when($type === 'all', function ($query) {
                return $query->whereNotIn('status_id', [self::HAPUS]);
            })
            ->when($type === 'aktif', function ($query) {
                return $query->where('status_id', self::ENABLE_STATUS_ID);
            })
            ->when($type === 'pending', function ($query) {
                return $query->where('status_id', self::PENDING_REVIEW_STATUS_ID);
            })
            ->when($type === 'draft', function ($query) {
                return $query->where('status_id', self::DRAFT);
            })
            ->groupBy('product_sku.id')
            ->count();
    }
}
