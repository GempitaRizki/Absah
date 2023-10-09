<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterBank extends Model
{
    use HasFactory;
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
