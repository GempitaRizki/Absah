<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankStore extends Model
{
    use HasFactory;
    protected $table = 'bank_store';

    protected $fillable = [
        'name',
        'number',
        'status_id',
        'store_id',
        'bank_id',
        'kode_bank',
    ];

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'status_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function bank()
    {
        return $this->belongsTo(MasterBank::class, 'bank_id');
    }

}
