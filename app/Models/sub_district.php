<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    protected $table = 'subdistricts';

    protected $fillable = [
        'name',
        'status',
        'districts_id',
        'id_intan',
        'id_dikbud',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'districts_id');
    }
}
