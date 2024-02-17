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
        $cities = Auth::user()->cityFavourite()->with(['city:id,city,country', 'city.weather'])->get();

        foreach($cities as $city)
        {
            if(Carbon::now()->diffInMinutes($city->city->weather->updated_at) > 5) {
                Artisan::call('weatherapi:forecast', ['city' => $city->city->city]);
                $city->refresh();
            }
        }

        return view('home', compact('cities'));
    }
    public function search(Request $request)
    {
        $cityName = $request->get('city');
        $cities = City::where('city', 'LIKE', '%'.$cityName.'%')->get();

        if(count($cities) == 0)
        {
            Artisan::call('weatherapi:forecast', ['city' => $cityName]);
            $output = json_decode(Artisan::output());

            if(isset($output->error))
            {
                return redirect()->back()->with('error', 'Ne postoji grad koji sadrzi: ' . $cityName);
            }

            UserCities::create([
                'user_id' => Auth::id(),
                'city_id' => $output->new_city_id
            ]);

            return redirect()->back();
        }

        $userFavourites = Auth::check() ? Auth::user()->cityFavourite->pluck('city_id')->toArray() : [];

        return view('searchResults', compact('cities', 'userFavourites'));
    }

    public function geolocation(Request $request)
    {
        $response = Http::withoutVerifying()->get('https://freeipapi.com/api/json/');
        return redirect()->back()->with('city', $response['cityName']);
    }
}
