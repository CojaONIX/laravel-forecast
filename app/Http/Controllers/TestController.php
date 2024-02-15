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
            'users',
            'user by id',
            'logged user',
            'cities',
            'cities with weather',
            'cities with forecasts',
            'city by name with forecasts',
            'cities with todaysForecast',
            'weathers',
            'weathers with city',
            'userFavourites',
            'reqres.in page',
            'weatherapi.com - current'

        ]]);
    }

    public function ajaxGetTestData(Request $request)
    {
        $item = $request->item;
        switch($request->action) {

            case('users'):
                return User::all();

            case('user by id'):
                try {
                    return User::findOrFail($item);
                } catch (Throwable $e) {
                    return [
                        'code' => 404,
                        'message' => 'User Not found - id=' . $item,
                        'Try with' => User::all()->pluck('id')
                    ];
                }

            case('logged user'):
                return Auth::user();

            case('cities'):
                return City::all();

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
                return UserCities::where(['user_id' => Auth::id()])->with(['city:id,city', 'city.todaysForecast'])->get();

            case('reqres.in page'):
                $response = Http::withoutVerifying()->get('https://reqres.in/api/users?page=2');
                return $response['data'];

            case('weatherapi.com - current'):
                $url = 'http://api.weatherapi.com/v1/current.json';

                if($item == '')
                    $item = 'Aleksinac';

                $response = Http::get($url, [
                        'key' => env('WEATHERAPI_KEY'),
                        'q' => $item,
                        'aqi' => 'yes'
                    ]);

                return $response->json();


            default:
                return [
                    'msg' => 'Bad action'
                ];
        }

    }
}
