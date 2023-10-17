<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOngkir extends Model
{
    protected $table = 'type_ongkir';

    protected $fillable = [
        'type', 'besaran'
    ];

    // Jika Anda memiliki hubungan dengan model lain, tambahkan metode relasinya di sini.
}
