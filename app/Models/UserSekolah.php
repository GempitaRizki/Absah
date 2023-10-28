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

    public function jumlahUserSekolahLogin()
    {
        return UserSekolah::select('user_sekolah.id')
            ->leftJoin('users', 'users.id', '=', 'user_sekolah.user_id')
            ->whereNotNull('users.logged_at')
            ->groupBy('user_sekolah.id')
            ->count();
    }

    public function jumlahUserSekolahLoginAktif()
    {
        return UserSekolah::select('user_sekolah.id')
            ->leftJoin('users', 'users.id', '=', 'user_sekolah.user_id')
            ->whereNotNull('users.logged_at')
            ->where('users.status', User::STATUS_ACTIVE)
            ->groupBy('user_sekolah.id')
            ->count();
    }

    public function jumlahUserSekolahLoginBeku()
    {
        return UserSekolah::select('user_sekolah.id')
            ->leftJoin('users', 'users.id', '=', 'user_sekolah.user_id')
            ->whereNotNull('users.logged_at')
            ->where('users.status', User::STATUS_NOT_ACTIVE)
            ->groupBy('user_sekolah.id')
            ->count();
    }
}
