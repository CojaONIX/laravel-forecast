<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class weatherapiCurrent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weatherapi:current {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'weatherapiCurrent: /current.json';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = env('WEATHERAPI_URL').'/current.json';
        $city = $this->argument('city');
        $response = Http::get($url, [
            'key' => env('WEATHERAPI_KEY'),
            'q' => $city
        ]);

        if($response->status() != 200)
        {
            $this->error($response['error']['message'] .  ' Argument city: ' . $city);
            dd();
        }

        $this->info(json_encode($response->json()));
        dd($this->description, $response->json(), $response['location']['name'].' - '.$response['location']['region'].' -> '.$response['current']['temp_c']);
    }
}
