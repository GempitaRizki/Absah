<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    protected $table = 'sumber_dana';

    protected $fillable = [
        'name',
        'code',
        'fund_id',
        'year',
        'closing_date',
    ];

}
