<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sekolah;

class NpwpDinas extends Model
{
    use HasFactory;
    protected $fillable = [
        'npwp',
        'npwp_dinas',
        'nama_dinas',
        'order_id',
        'alamat_dinas',
        'sekolah_id',
        'used_dinas'
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
