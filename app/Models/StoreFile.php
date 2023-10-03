<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFile extends Model
{

    protected $table = 'store_file';

    protected $fillable = [
        'storefile',
        'storefile_bash_url',
        'store_id',
        'file_category',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    
}

