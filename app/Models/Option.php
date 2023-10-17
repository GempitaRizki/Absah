<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';

    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public static function getListOption()
    {
        $listOptions = Option::orderBy('id')->pluck('name', 'id')->all();

        return $listOptions;
    }
}
