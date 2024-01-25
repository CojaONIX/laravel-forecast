<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Forecast;
use App\Models\Weather;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
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

        $faker = Factory::create('sr_Latn_RS'); // create('sr_Latn_RS')
        $console->progressStart($amount);

        $newCitiesIds = array();
        for($i=0; $i<$amount; $i++)
        {
            try {
                $dbCity = City::create([
                    "city" => mb_strtolower($faker->city(), 'UTF-8')
                ]);
                $newCitiesIds[] = $dbCity->id;
            } catch (Throwable $e) {
            }
            $console->progressAdvance();
        }

        $console->progressFinish();
        $count = count($newCitiesIds);
        $console->info("Uspesno je kreirano $count gradova.");

        foreach ($newCitiesIds as $city_id)
        {
            Weather::create([
               'city_id' => $city_id,
               'temperature' => $faker->randomFloat(1, -10, 30)
            ]);

            for ($i=1; $i<6; $i++)
            {
                $weatherType = Forecast::WEATHERS[rand(0 ,2)];
                $probability = $weatherType == 'sunny' ? null : rand(1, 100);

                Forecast::create([
                    'city_id' => $city_id,
                    'temperature' => $faker->randomFloat(1, -10, 30),
                    'date' => Carbon::now()->addDays($i)->format('Y-m-d'),
                    'weather_type' => $weatherType,
                    'probability' => $probability
                ]);
            }

        }
    }
}
