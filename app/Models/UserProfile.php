<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    const GENDER_MALE = 1;

    const GENDER_FEMALE = 2;
    
    use HasFactory;

    protected $table = 'user_profile';

    protected $fillable = [
        'user_id', 'firstname', 'middlename', 'lastname', 'avatar_path', 'avatar_base_url', 'locale', 'gender', 'phone_number', 'jabatan', 'kode_instansi', 'nitk', 'nuptk', 'nip', 'lpseid', 'isLatihan', 'npwp'
    ];

    public function getUserId()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
