<?php

namespace App\Http;

class TemperatureColorHelper
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
}
