<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class npwp_dinas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'npwp_dinas'
    ];

    protected $hidden = [
        'id'
    ];

    public function Sekolah()
    {
        return $this->belongsTo('App\Models\Sekolah');
    }
}
