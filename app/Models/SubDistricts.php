<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistricts extends Model
{
    use HasFactory;
    protected $table = 'subdistricts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status',
        'districts_id',
        'id_intan',
        'id_dikbud',
    ];

    public function district()
    {
        return $this->belongsTo(Districts::class, 'districts_id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'subdistrict_id');
    }
}
