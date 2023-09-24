<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBank extends Model
{
    protected $table = 'master_bank';

    protected $fillable = [
        'name',
        'status_id',
        'type',
    ];

    public function status()
    {
        return $this->belongsTo(MasterStatus::class, 'status_id');
    }
}
