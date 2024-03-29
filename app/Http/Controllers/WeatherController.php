<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeathers()
    {
        //$weathers = Weather::all();
        $weathers = Weather::with('city:id,city')->get();
        return view('weather', compact('weathers'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'temperature' => 'required|numeric',
            'city_id' => 'required|exists:cities,id'
        ]);

        $weather = Weather::where(['city_id' => $request->get('city_id')])->first();
        $weather->temperature = $request->get('temperature');
        $weather->save();

        return redirect()->back();
    }
}
