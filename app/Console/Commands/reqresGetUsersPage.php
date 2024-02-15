<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class reqresGetUsersPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reqres:get-users-page';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reqresGetUsersPage: https://reqres.in/api/users?page=2';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = 'https://reqres.in/api/users?page=2';

        $response = Http::withoutVerifying()->get($url);
        $responseASOC = json_decode($response, true); // ???
        dd($this->description, $response['data']);

    }
}
