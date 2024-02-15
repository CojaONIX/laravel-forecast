<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class reqresCreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reqres:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reqresCreateUser: https://reqres.in/api/users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = 'https://reqres.in/api/users';

        $response = Http::withoutVerifying()->post($url, [
            "name" => "Goran",
            "job"=> "laravel"
        ]);

        dd($this->description, $response->json());
    }
}
