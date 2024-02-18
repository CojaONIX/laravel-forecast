<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{

    public function getWeather($city)
    {
        $response = Http::get(env('WEATHERAPI_URL') . '/forecast.json', [
            'key' => env('WEATHERAPI_KEY'),
            'q' => $city,
            'days' => 1, // default: 1 (current date)
            'hour' => 12 // default: all hours
        ]);

        return $response;
    }

    public function getAstronomy($city)
    {
        $response = Http::get(env('WEATHERAPI_URL') . '/astronomy.json', [
            'key' => env('WEATHERAPI_KEY'),
            'q' => $city
        ]);

        return $response['astronomy']['astro'];
    }
}
