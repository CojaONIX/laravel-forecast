<?php

namespace App\Http\Controllers;

use App\Models\UserCities;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\City;
use App\Models\Forecast;
use App\Models\Weather;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;
use Throwable;

class TestController extends Controller
{
    public function showTest(Request $request)
    {
        return view('test', ['buttons' => [
            'test1',
            'test2',
            'cities with weather',
            'cities with forecasts',
            'city by name with forecasts',
            'cities with todaysForecast',
            'weathers',
            'weathers with city',
            'userFavourites',
            'reqres.in page',
            'weatherapi.com - current',
            'weatherapi.com - forecast',
            'freeipapi.com'

        ]]);
    }

    public function ajaxGetTestData(Request $request)
    {
        $item = $request->item;
        switch($request->action) {

            case('test1'):
                $userFavourites = Auth::check() ? Auth::user()->cityFavourite->pluck('city_id')->toArray() : [];
                return Weather::whereIn('city_id', $userFavourites)->with('city')->get();

            case('test2'):
                return Auth::user()->cityFavourite()->with(['city', 'city.weather'])->get();



            case('cities with weather'):
                return City::with('weather')->get();

            case('cities with forecasts'):
                return City::with('forecasts')->get();

            case('city by name with forecasts'):
                return City::where(['city' => $item])->with('forecasts')->first();

            case('cities with todaysForecast'):
                return City::with('todaysForecast')->where('city', 'LIKE', '%'.$item.'%')->get();

            case('weathers'):
                return Weather::all();

            case('weathers with city'):
                return Weather::with('city:id,city')->get();

            case('userFavourites'):
                return UserCities::where(['user_id' => Auth::id()])->with(['city:id,city,country', 'city.todaysForecast'])->get();

            case('reqres.in page'):
                $response = Http::withoutVerifying()->get('https://reqres.in/api/users?page=2');
                return $response['data'];

            case('weatherapi.com - current'):
                $url = 'http://api.weatherapi.com/v1/current.json';

                if($item == '')
                    $item = 'Aleksinac';

                $response = Http::get($url, [
                        'key' => env('WEATHERAPI_KEY'),
                        'q' => $item
                    ]);

                return $response->json();

            case('weatherapi.com - forecast'):
                $url = 'http://api.weatherapi.com/v1/forecast.json';

                if($item == '')
                    $item = 'Aleksinac';

                $response = Http::get($url, [
                    'key' => env('WEATHERAPI_KEY'),
                    'q' => $item,
                    'days' => 1,
                    'hour' => 12
                ]);

                return $response->json();

            case('freeipapi.com'):
                return Http::withoutVerifying()->get('https://freeipapi.com/api/json/');


            default:
                return [
                    'msg' => 'Bad action'
                ];
        }

    }
}
