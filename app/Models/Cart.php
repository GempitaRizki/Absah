<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'user_id',
        'store_id',
        'status',
    ];

    public function user()
    {
        return $this->belongTo(User::class, 'user_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
