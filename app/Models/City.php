<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'city',
    ];

    public function weather()
    {
        return $this->hasOne(Weather::class);
    }

    public function forecasts()
    {
        return $this->hasMany(Forecast::class)->orderBy('date');
    }

    public function todaysForecastIcon()
    {
        return $this->hasOne(Forecast::class)->whereDate('date', Carbon::now())->withDefault('null');
    }
}
