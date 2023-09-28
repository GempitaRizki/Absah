<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NpwpDinas;

class Sekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_sekolah',
        // 'data_pengguna',
        // 'sekolah',
        'alamat',
        'bentuk_pendidikan',
        // 'bujur',
        'kelurahan',
        'email_sekolah',
        'kota',
        'kabupaten',
        'kecamatan',
        'kepala_sekolah',
        'kode_pos',
        // 'lintang',
        // 'nama_sekolah',
        'nip_bendahara_bos',
        'nip_kepala_sekolah',
        'no_sekolah',
        'npsn',
        'provinsi',
        // 'sekolah_id',
        'status',
        // 'zona',
        'npwp_dinas',
        'bendahara_bos'
        
    ];

    public function NpwpDinas()
    {
        return $this->hasOne(NpwpDinas::class);
    }
};
