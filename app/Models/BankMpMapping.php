<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankMpMapping extends Model
{
    use HasFactory;
    protected $table = 'bank_mp_mapping';

    protected $fillable = [
        'bank_mp_id',
        'province_id',
        'status_id',
    ];

}
