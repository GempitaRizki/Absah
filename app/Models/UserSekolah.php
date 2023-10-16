<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSekolah extends Model
{
    protected $table = 'user_sekolah';

    protected $fillable = [
        'sekolah_id',
        'user_id',
        'status',
        'kode_wilayah',
        'nama',
        'nik',
        'nip',
        'no_telepon',
        'pengguna_id',
        'jabatan',
        'peran',
        'peran_id',
        'sekolah_id_json',
        'username',
        'status_beku',
    ];

    protected $dates = ['created_at', 'updated_at'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
