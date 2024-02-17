<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
        $url = env('WEATHERAPI_URL').'/forecast.json';
        $city = $this->argument('city');
        $response = Http::get($url, [
            'key' => env('WEATHERAPI_KEY'),
            'q' => $city,
            'days' => 1, // default: 1 (current date)
            'hour' => 12 // default: all hours
        ]);

        if($response->status() != 200)
        {
            $this->error($response['error']['message'] .  ' Argument city: ' . $city);
            dd();
        }

        //$this->info(json_encode($response->json()));
        dd($this->description, $response->json());
    }
}
