<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $table = 'weathers';

    protected $fillable = [
        'city_id',
        'temperature',
        'date',
        'weather_type',
        'probability',
        'icon'
    ];

//    public function city()
//    {
//        return $this->hasOne(City::class, 'id', 'city_id');
//    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
