<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getWeather($city)
    {
        $url = env('WEATHERAPI_URL').'/forecast.json';
        $response = Http::get($url, [
            'key' => env('WEATHERAPI_KEY'),
            'q' => $city,
            'days' => 1, // default: 1 (current date)
            'hour' => 12 // default: all hours
        ]);

        return $response;
    }
}
