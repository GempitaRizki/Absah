<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    protected $table = 'village'; 
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'name',
        'status',
        'subdistrict_id',
        'id_intan',
        'id_dikbud',
    ];

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class, 'subdistrict_id');
    }
}
