<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreDetail extends Model
{
    use HasFactory;

    protected $table = 'store_detail';

    protected $primaryKey = 'id';

    protected $fillable =
    [
        'nib',
        'skb',
        'akta',
        'akta_perusahaan',
        'npwp',
        'siup',
        'tdp',
        'kbli',
        'latitude',
        'longtitude',
        'store_id',
        'pkp',
        'kategori_usaha',
        'kepemilikan_usaha',
        'wilayah_usaha',
        'req_fitur_pajak',
        'aktif_fitur_pajak',
        'upload_sertel_pajak',

    ];

    protected $casts = [
        'store_id' => 'string', 
    ];

    public function store()
    {
        return $this->belongTo(Store::class, 'store_id');
    }

    public function kategoriusaha()
    {
        return $this->belongsTo(MasterStatus::class, 'kategori_usaha');
    }

    public function kepemilikanusaha()
    {
        return $this->belongsTo(MasterStatus::class, 'kepemilikan_usaha');
    }

    public function wilayahusaha()
    {
        return $this->belongsTo(MasterStatus::class, 'wilayah_usaha');
    }

    public function pkp()
    {
        return $this->belongsTo(MasterStatus::class, 'pkp');
    }

}