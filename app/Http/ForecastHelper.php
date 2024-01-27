<?php

namespace App\Http;

use Throwable;

class ForecastHelper
{
    public static function getColorByTemperature($temperature)
    {
        if($temperature <= 0)
        {
            $color = 'lightblue';
        }
        elseif($temperature <= 15)
        {
            $color = 'blue';
        }
        elseif($temperature <= 25)
        {
            $color = 'green';
        }
        else
        {
            $color = 'red';
        }

        return $color;
    }

    const WEATHER_ICONS = [
        'sunny'=> 'sun',
        'cloudy' => 'cloud',
        'rainy' => 'cloud-rain',
        'snowy' => 'snowflake'
    ];
    public static function getIconByWeatherType($type)
    {
        try {
            return self::WEATHER_ICONS[$type];
        } catch (Throwable $e) {
            return 'x';
        }
    }
}
