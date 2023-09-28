<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status',
        'province_id',
        'id_intan',
        'zona_kumer',
        'id_dikbud',
        'url_gambar',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function subdistricts()
    {
        return $this->hasMany(SubDistricts::class, 'districts_id');
    }
}
