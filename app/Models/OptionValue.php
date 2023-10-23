<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;

    protected $table = 'option_value';

    protected $fillable = [
        'name',
        'color_code',
        'option_id',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }

    public static function getListOptionValue($data)
    {
        $listOptionValue = collect(OptionValue::where('option_id', $data)
            ->orderBy('id')
            ->get())
            ->mapWithKeys(function ($item) {
                return [$item['id'] => $item['name']];
            });

        return $listOptionValue;
    }
}
