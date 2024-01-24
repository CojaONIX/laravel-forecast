<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AskUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $console = $this->command->getOutput();
        $email = $console->ask("Unesite email korisnika?");
        if($email === null)
        {
            $console->error("Niste uneli email korisnika!");
            return;
        }

        $dbUser = User::where(['email' => $email])->first();
        if($dbUser instanceof User)
        {
            $console->error("U bazi vec postoji korisnik $email!");
            return;
        }

        $name = $console->ask("Unesite naziv korisnika?");
        if($name === null)
        {
            $console->error("Niste uneli naziv korisnika!");
            return;
        }

        $password = $console->ask("Unesite password korisnika?");
        if($password === null)
        {
            $console->error("Niste uneli password korisnika!");
            return;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        $console->success("Uspesno ste uneli novog korisnika!");
        $console->table(['Name', 'Email', 'Password'], [['email' => $email, 'name' => $name, 'password' => $password]]);
    }
}
