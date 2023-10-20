<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryExtended extends Model
{
    use HasFactory;

    protected $table = "product_category";

    public $timestamps = true;

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
        'kat_agregasi'
    ];

    public function children()
    {
        
    }
}
