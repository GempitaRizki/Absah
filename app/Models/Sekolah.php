<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
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

    public function npwp_dinas()
    {
        return $this->hasMany('App\Models\npwp_dinas');
    }

};
