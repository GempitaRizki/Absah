<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'hierarchy',
        'hierarchy_name',
        'level',
        'status_id',
        'logo',
        'bash_logo',
        'descriptions',
        'type_category',
        'dikbud_type',
        'urut',
        'dikbud',
        'kat_agregasi',
    ];

}

