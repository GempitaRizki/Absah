<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;
    protected $table = 'product_sku';
    protected $primaryKey = 'id';

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
    ];

    public const DRAFT = 0;

    public const ACTIVE = 1;

    public const INACTIVE = 2;

    public const STATUSES = [
        self::DRAFT => 'draft',
        self::ACTIVE => 'active',
        self::INACTIVE => 'inactive'
    ];

    public const SIMPLE = 'simple';

    public const CONFIGURABLE = 'configurable';

    public const TYPES = [
        self::SIMPLE => 'Simple',
        self::CONFIGURABLE => 'Configurable'
    ];

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

    public function hasPpn()
    {
        return $this->belongsTo(MasterStatus::class, 'has_ppn');
    }

    public function hasShipping()
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

    public static function statuses()
    {
        return [ 
            0 =>'draft',
            1 => 'active',
            2 => 'inactive'
        ];
    }

    public function statusLabel()
    {
        $statuses = $this->statuses();

        return isset($this->status) ? $statuses[$this->status] : null;
    }

    public function typePpn()
    {
        return $this->belongsTo(MasterStatus::class, 'type_ppn');
    }
}
