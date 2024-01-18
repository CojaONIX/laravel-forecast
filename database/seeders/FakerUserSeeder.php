<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Throwable;

class FakerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $console = $this->command->getOutput();
        $amount = $console->ask('Koliko korisnika zelite da kreirate?', 5);
        $password = $console->ask('Koja je sifra za sve korisnike?', 'password');

        $faker = Factory::create();
        $console->progressStart($amount);
        for($i=0; $i<$amount; $i++)
        {
            try {
                User::create([
                    "name" => $faker->name(),
                    "email" => $faker->unique()->safeEmail(),
                    "password" => Hash::make($password)
                ]);
            } catch (Throwable $e) {
                $amount--;
            }
            $console->progressAdvance();
        }
        $console->progressFinish();
        $console->info("Uspesno je kreirano $amount korisnika");
    }
}
