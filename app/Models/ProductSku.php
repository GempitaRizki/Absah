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

    public function typePpn()
    {
        return $this->belongsTo(MasterStatus::class, 'type_ppn');
    }
}

