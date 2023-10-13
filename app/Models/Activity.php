<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'order_id',
        'action',
        'agregasi_json',
        'agregasi_status',
        'endpoint',
        'type_agregasi',
        'metadata',
        'user_agent',
        'ip',
        'ipinfo',
        'reference_id',
        'dateUTC',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
