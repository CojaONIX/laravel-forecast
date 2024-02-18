<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Forecast;
use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ForecastController extends Controller
{
    public function getAllForecasts()
    {
        $forecasts = Forecast::with('city')->get();
        return view('admin.forecast.all', compact('forecasts'));
    }

    public function addForecastPage()
    {
        return view('admin.forecast.add');
    }

    public function createForecast(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|min:2|max:64|unique:forecasts',
            'temperature' => 'required|numeric'
        ]);

        Forecast::create([
            'city' => $request->get('city'),
            'temperature' => $request->get('temperature')
        ]);

        return redirect()->route('admin.forecast.all.page')->withSuccess('Forecast is created.');
    }

    public function editForecastPage(Forecast $forecast)
    {
        return view('admin.forecast.edit', compact('forecast'));
    }

    public function updateForecast(Request $request, Forecast $forecast)
    {
        $validated = $request->validate([
            'city' => 'required|string|min:2|max:64|unique:forecasts,city,'.$forecast->id,
            'temperature' => 'required|numeric'
        ]);

        $forecast->city = $request->get('city');
        $forecast->temperature = $request->get('temperature');

        $forecast->save();

        return redirect()->route('admin.forecast.all.page')->withSuccess('Forecast ' . $forecast->id . ' is edited.');
    }

    public function deleteForecast(Request $request, Forecast $forecast)
    {
        $forecast->delete();

        return redirect()->route('admin.forecast.all.page')->withSuccess('Forecast is deleted.');
    }

    public function getCityForecasts(City $city)
    {
//        $city = strtolower($city); // ???
//        $cityForecasts = City::where(['city' => $city])->with('forecasts')->first(); // No Model binding
//        $cityForecasts = City::where(['id' => $city->id])->with('forecasts')->first(); // Model binding

//        $prognoze = Forecast::where(['city_id' => $city->id])->get();
//        dd($prognoze);

//        $cityForecasts = $city->load('forecasts');
//        return view('cityForecast', compact('cityForecasts'));

        $response = Http::get('http://api.weatherapi.com/v1/astronomy.json', [
            'key' => env('WEATHERAPI_KEY'),
            'q' => $city->city
        ]);

        $astro = $response['astronomy']['astro'];

        return view('cityForecast', compact('city', 'astro'));  // 14.8
    }

    public function forecastsAll()
    {
        $cities = City::with('forecasts')->get();
        return view('admin.forecast.forecasts', compact('cities'));
    }

    public function forecastsAdd(Request $request)
    {
        $valid = $request->validate([
            'temperature' => 'required|numeric',
            'city_id' => 'required|exists:cities,id',
            'date' => 'required',
            'weather_type' => 'required',
            'probability' => 'nullable'
        ]);

        if($valid['weather_type'] == 'sunny')
        {
            $valid['probability'] = null;
        }

        Forecast::create($valid);

        return redirect()->back();
    }
}
