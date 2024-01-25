<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    protected $table = 'forecasts';

    protected $fillable = [
        'city_id',
        'temperature',
        'date',
        'weather_type',
        'probability'
    ];

    const WEATHERS = ['rainy', 'sunny', 'snowy'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
