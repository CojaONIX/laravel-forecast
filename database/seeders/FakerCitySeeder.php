<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory;
use App\Models\City;
use Throwable;

class FakerCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $console = $this->command->getOutput();
        $amount = $console->ask('Koliko gradova zelite da kreirate?', 100);

        $faker = Factory::create();
        $console->progressStart($amount);
        $count = 0;
        for($i=0; $i<$amount; $i++)
        {
            try {
                City::create([
                    "city" => $faker->city()
                ]);
                $count++;
            } catch (Throwable $e) {
            }
            $console->progressAdvance();
        }
        $console->progressFinish();
        $console->info("Uspesno je kreirano $count gradova.");
    }
}
