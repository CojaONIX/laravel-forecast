<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Forecast;
use App\Models\UserCities;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $userFavourites = Auth::check() ? Auth::user()->cityFavourite->pluck('city_id')->toArray() : [];
        $forecasts = Weather::whereIn('city_id', $userFavourites)->with('city')->get();
        //$cities = Auth::user()->cityFavourite()->with(['city', 'city.weather'])->get();

        foreach($forecasts as $forecast)
        {
            if(Carbon::now()->diffInMinutes($forecast->updated_at) > 1) {
                $url = env('WEATHERAPI_URL') . '/forecast.json';
                $response = Http::get($url, [
                    'key' => env('WEATHERAPI_KEY'),
                    'q' => $forecast->city->city,
                    'days' => 1, // default: 1 (current date)
                    'hour' => 12 // default: all hours
                ]);

                $forecast->temperature = $response['current']['temp_c'];
                $forecast->date = Carbon::now()->format('Y-m-d');
                $forecast->weather_type = $response['current']['condition']['text'];
                $forecast->probability = $response['forecast']['forecastday'][0]['day']['daily_chance_of_rain'];
                $forecast->icon = $response['current']['condition']['icon'];

                $forecast->save();
            }
        }


        $cities = UserCities::where(['user_id' => Auth::id()])->with(['city:id,city,country', 'city.weather'])->get();

        return view('home', compact('cities'));
    }
    public function search(Request $request)
    {
        $cityName = $request->get('city');
        $cities = City::with('todaysForecast')->where('city', 'LIKE', '%'.$cityName.'%')->get();

        if(count($cities) == 0)
        {
//            $apiResponse = Artisan::call('weatherapi:forecast', ['city' => $cityName]);
//            dd($apiResponse);

            $url = env('WEATHERAPI_URL').'/forecast.json';
            $response = Http::get($url, [
                'key' => env('WEATHERAPI_KEY'),
                'q' => $cityName,
                'days' => 1, // default: 1 (current date)
                'hour' => 12 // default: all hours
            ]);

            if($response->status() != 200)
            {
                return redirect()->back()->with('error', 'Ne postoji grad koji sadrzi: ' . $cityName);
            }

            $dbCity = City::create([
                "city" => mb_strtolower($cityName, 'UTF-8'),
                'country' => $response['location']['country']
            ]);

            Weather::create([
                'city_id' => $dbCity->id,
                'temperature' => $response['current']['temp_c'],
                'date' => Carbon::now()->format('Y-m-d'),
                'weather_type' => $response['current']['condition']['text'],
                'probability' => $response['forecast']['forecastday'][0]['day']['daily_chance_of_rain'],
                'icon' => $response['current']['condition']['icon']
            ]);

            UserCities::create([
                'user_id' => Auth::id(),
                'city_id' => $dbCity->id
            ]);

            return redirect()->back();

        }

        $userFavourites = Auth::check() ? Auth::user()->cityFavourite->pluck('city_id')->toArray() : [];

        return view('searchResults', compact('cities', 'userFavourites'));
    }
}
