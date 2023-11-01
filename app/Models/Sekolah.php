<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NpwpDinas;
use Illuminate\Support\Facades\Auth;

class Sekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_sekolah',
        'data_pengguna',
        'sekolah',
        'alamat',
        'bentuk_pendidikan',
        'bujur',
        'kelurahan',
        'email_sekolah',
        'kota',
        'kabupaten',
        'kecamatan',
        'kepala_sekolah',
        'kode_pos',
        'lintang',
        'nama_sekolah',
        'nip_bendahara_bos',
        'nip_kepala_sekolah',
        'no_sekolah',
        'npsn',
        'provinsi',
        'sekolah_id',
        'status',
        'zona',
        'npwp_dinas',
        'bendahara_bos'

    ];

    public static function getSekolahId()
    {
        $userId = Auth::id();
        $sekolahDetailUser = UserSekolah::where('user_id', $userId)
            ->where('status', 1)
            ->first();

        if ($sekolahDetailUser) {
            return $sekolahDetailUser->sekolah_id;
        } else {
            return 0;
        }
    }

    public static function getListSekolah()
    {
        $listMasterProductType = Sekolah::select('id', 'nama_sekolah as name')
            ->orderBy('id')
            ->get()
            ->pluck('name', 'id')
            ->toArray();

        return $listMasterProductType;
    }

    public function jumlahSekolahLogin()
    {
        $query = Sekolah::join('user_sekolah as us', 'sekolah.id', '=', 'us.sekolah_id')
            ->join('user as u', 'u.id', '=', 'us.user_id')
            ->whereNotNull('logged_at')
            ->groupBy('sekolah.id')
            ->count();

        return $query;
    }

    public function jumlahSekolahTransaksi()
    {
        $query = Sekolah::join('user_sekolah as us', 'us.sekolah_id', '=', 'sekolah.id')
            ->join('order as o', 'o.user_id', '=', 'us.user_id')
            ->groupBy('o.user_id', 'sekolah.id')
            ->count();

        return $query;
    }

    public static function getSekolahDistrict()
    {
        $userId = Auth::id();

        $sekolahDetailUser = UserSekolah::where('user_id', $userId)
            ->where('status', 1)
            ->first();

        if ($sekolahDetailUser) {
            $sekolahId = $sekolahDetailUser->sekolah_id;
            $sekolah = Sekolah::where('id', $sekolahId)->first();

            if ($sekolah) {
                return $sekolah->kd_kab;
            }
        }

        return 'default_kd_kab';
    }
};
