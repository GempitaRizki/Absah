<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStatus extends Model
{
    use HasFactory;
    protected $table = 'master_status';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'name',
        'name_alias',
        'descriptions',
        'label_status',
        'is_status',
        'is_visible',
    ];

}
