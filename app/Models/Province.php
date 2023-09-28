<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'province';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status',
        'id_intan',
        'id_dikbud',
        'location_id',
    ];


    public function districts()
    {
        return $this->hasMany(Districts::class, 'province_id');
    }
}
