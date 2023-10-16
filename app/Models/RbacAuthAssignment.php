<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RbacAuthAssignment extends Model
{
    protected $table = 'rbac_auth_assignment';

    protected $primaryKey = 'id'; 

    public $timestamps = true; 


    protected $fillable = [
        'item_name',
        'user_id',
    ];
}