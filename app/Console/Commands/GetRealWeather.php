<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-real';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'https://www.weatherapi.com/ -> Real-time Weather API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = 'https://reqres.in/api/users?page=2';

        $response = Http::withoutVerifying()->get($url);
        $responseASOC = json_decode($response, true); // ???
        dd($response['data'][0]);

    }
}