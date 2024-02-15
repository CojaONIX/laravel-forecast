<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetSingleUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-single-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GetSingleUser: https://reqres.in/api/users/2';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $console = $this->getOutput();
        $id = $console->ask("Unesite id korisnika? (max: 12)", 1);

        $response = Http::withoutVerifying()->get('https://reqres.in/api/users/' . $id);
        dd($this->description, $response['data']);
    }
}
