<?php

namespace App\Http;

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

    public static function getIconByWeatherType($type)
    {
        $types = [
            'rainy' => 'cloud-rain',
            'sunny'=> 'sun',
            'snowy' => 'snowflake'
        ];

        if(!array_key_exists($type, $types))
        {
            return 'x';
        }

        return $types[$type];
    }
}
