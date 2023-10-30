<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IprProduct extends Model
{
    protected $table = 'ipr_product';
    protected $primaryKey = 'id';


    protected $fillable = [
        'product_type',
        'condition_id',
        'price_type',
        'shipping_type',
        'pdf_spec',
        'attribute',
        'attribute_value',
        'type_category',
        'prakatalog'
    ];

    const PRODUCT_TYPE_VARIANT = '31';
    const PRODUCT_TYPE_PRICE_ZONASI = '37';
    const PRODUCT_TYPE_PRICE_NASIONAL = '38';
    const PRODUCT_TYPE_PRICE_GROSIR = '39';

    const PRODUCT_TYPE_SHIPPING_PERKAB = '50';
    const PRODUCT_TYPE_SHIPPING_FLAT = '53';
    const PRODUCT_TYPE_SHIPPING_RAJAONGKIR = '51';
    const PRODUCT_TYPE_SHIPPING_AGEN = '52';

    const PRODUCT_CONDITION = '24';
    const TYPE_CATEGORY_JASA = '116';
    const TYPE_CATEGORY_BARANG = '115';

    public function ProductType()
    {
        return $this->belongsTo(MasterStatus::class, 'product_type');
    }

    public function Condition()
    {
        return $this->belongsTo(MasterStatus::class, 'condition_id');
    }

    public function PriceType()
    {
        return $this->belongsTo(MasterStatus::class, 'price_type');
    }

    public function ProductSkuId()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id');
    }

    public function iprProduct()
    {
        return $this->belongsTo(IprProduct::class, 'product_id', 'id');
    }
}    
