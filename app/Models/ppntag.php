<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ppntag extends Model
{
    use HasFactory;

    protected $table = 'ppn_tag';

    protected $fillable = [
        'tag_id', 'is_ppn', 'name', 'description', 'jenis', 'kab_id', 'id_districts'
    ];

}
