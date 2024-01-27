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
        $amount = $console->ask('Koliko gradova zelite da kreirate?', 10);

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

        $weatherTypesRanges = [
            'sunny' => ['min' => -100, 'max' => 100],
            'cloudy' => ['min' => -100, 'max' => 15],
            'rainy' => ['min' => -10, 'max' => 100],
            'snowy' => ['min' => -100, 'max' => 1]
        ];

        foreach ($newCitiesIds as $city_id)
        {
            $temp = $faker->randomFloat(1, -30, 40);
            Weather::create([
               'city_id' => $city_id,
               'temperature' => $temp
            ]);

            for ($i=1; $i<6; $i++)
            {
                $weatherTypesByTemp = array();
                $temp = $faker->randomFloat(1, max(-30, $temp - 5), min(40, $temp + 5));

                foreach($weatherTypesRanges as $type => $range)
                {
                    if($temp >= $range['min'] and $temp <= $range['max'])
                    {
                        $weatherTypesByTemp[] = $type;
                    }
                }

                //dd($temp, $weatherTypesByTemp);

                $weatherType = $weatherTypesByTemp[rand(0, count($weatherTypesByTemp) - 1)];
                $probability = $weatherType == 'sunny' ? null : rand(1, 100);

                Forecast::create([
                    'city_id' => $city_id,
                    'temperature' => $temp,
                    'date' => Carbon::now()->addDays($i)->format('Y-m-d'),
                    'weather_type' => $weatherType,
                    'probability' => $probability
                ]);
            }

        }
    }
}
