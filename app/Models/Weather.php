<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $table = 'weathers';

    protected $fillable = [
        'city_id',
        'temperature'
    ];

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
