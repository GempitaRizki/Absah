<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolahs extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_sekolah',
        'data_pengguna',
        'sekolah',
        'alamat',
        'bendahara_bos',
        'bentuk_pendidikan',
        'bujur',
        'kelurahan',
        'email',
        'kota',
        'kd_kab',
        'kecamatan',
        'kepala_sekolah',
        'kode_pos',
        'lintang',
        'nama_sekolah',
        'nip_bendahara_bos',
        'nip_kepala_sekolah',
        'no_sekolah',
        'npsn',
        'npwp',
        'provinsi',
        'sekolah_id',
        'status',
        'zona',
        'jenjang'
    ];

    public function NpwpDinas()
    {
        return $this->hasOne(NpwpDinas::class);
    }
};
