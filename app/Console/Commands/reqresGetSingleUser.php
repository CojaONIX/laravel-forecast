<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class reqresGetSingleUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reqres:get-single-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reqresGetSingleUser: https://reqres.in/api/users/2';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->ask("Unesite id korisnika? (max: 12)", 1);
        $response = Http::withoutVerifying()->get('https://reqres.in/api/users/' . $id);

        dd($this->description, $response['data']);
    }
}
