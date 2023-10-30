<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IprCart extends Model
{
    use HasFactory;

    protected $table = 'ipr_cart';
    

    protected $fillable = [
        'status_id', 
        'user_id', 
        'store_id', 
        'sumber_dana_id', 
        'shipping_method', 
        'denda', 
        'etimasi_pebayaran', 
        'shipping_estimate', 
        'shipping_note', 
        'shipping_cos', 
        'sekolah_id', 
        'payment_method', 
        'shipping_method_code', 
        'category_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }

    public function store()
    {
        $this->belongsTo(Store::class, 'store_id');
    }


}
