<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cities = City::with('todaysForecastType')->get();
        return view('home', compact('cities'));
    }
    public function search(Request $request)
    {
        $cityName = $request->get('city');
        $cities = City::with('todaysForecastType')->where('city', 'LIKE', '%'.$cityName.'%')->get();

        if(count($cities) == 0)
        {
            return redirect()->back()->with('error', 'Ne postoji grad koji sadrzi: ' . $cityName);
        }
        return view('home', compact('cities'));
    }
}
