<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{

    protected $table = 'zona';

    const ZONA_DIKBUD = 1;

    private static $_statuses = [
        self::ZONA_DIKBUD => 'Zona Dikbud',
    ];

    protected $fillable = [
        'name',
        'label',
        'created_at',
        'updated_at',
    ];

    public function rules()
    {
        return array_replace_recursive(parent::rules(), [
            [['name', 'label'], 'required'],
            [['name', 'label'], 'string', 'max' => 45],
            [['created_at', 'updated_at'], 'integer'],
        ]);
    }

    public static function statuses()
    {
        return self::$_statuses;
    }

    public static function getStatuses($statuses)
    {
        return !empty(self::$_statuses[$statuses]) ? self::$_statuses[$statuses] : null;
    }

    public static function getZona($zonaLabel)
    {
        $data = static::where('label', $zonaLabel)->select(['id', 'name'])->get()->toArray();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
}
