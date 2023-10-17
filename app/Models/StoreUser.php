<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreUser extends Model
{
    use HasFactory;

    protected $table = 'store_user';

    protected $fillable = [
        'public_name',
        'store_id',
        'user_id',
    ];

    public static function validationRules()
    {
        return [
            'created_at' => 'integer',
            'updated_at' => 'integer',
            'store_id' => 'required|integer',
            'user_id' => 'required|integer',
            'public_name' => 'string|max:100',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
