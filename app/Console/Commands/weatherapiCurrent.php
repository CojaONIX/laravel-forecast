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
        $response = Http::get($url, [
            'key' => env('WEATHERAPI_KEY'),
            'q' => $this->argument('city')
        ]);

        $responseJSON = $response->json();
        dd($this->description, $responseJSON, $responseJSON['location']['name'].' - '.$responseJSON['location']['region'].' -> '.$responseJSON['current']['temp_c']);
    }
}
