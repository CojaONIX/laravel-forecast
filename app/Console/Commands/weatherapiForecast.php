<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\UserCities;
use App\Models\Weather;
use App\Services\WeatherService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class weatherapiForecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weatherapi:forecast {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'weatherapiCurrent: /forecast.json';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $city = $this->argument('city');

        $weatherService = new WeatherService();
        $response = $weatherService->getWeather($city);

        if($response->status() != 200)
        {
            $this->info(json_encode(['error' => $response['error']['message'] . ' Argument city: ' . $city]));
            return;
        }

        $dbCity = City::firstOrCreate([
            "city" => mb_strtolower($city, 'UTF-8'),
            'country' => $response['location']['country']
        ]);

        Weather::updateOrCreate(
            ['city_id' => $dbCity->id],
            [
                'temperature' => $response['current']['temp_c'],
                'date' => Carbon::now()->format('Y-m-d'),
                'weather_type' => $response['current']['condition']['text'],
                'probability' => $response['forecast']['forecastday'][0]['day']['daily_chance_of_rain'],
                'icon' => $response['current']['condition']['icon'],
            ]
        );

        $this->info(json_encode(['new_city_id' => $dbCity->id]));

    }
}
