<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $cities = City::with('todaysForecastType')->get();
        $userFavourites = Auth::check() ? Auth::user()->cityFavourite->pluck('city_id')->toArray() : [];
        return view('home', compact('cities', 'userFavourites'));
    }
    public function search(Request $request)
    {
        $cityName = $request->get('city');
        $cities = City::with('todaysForecastType')->where('city', 'LIKE', '%'.$cityName.'%')->get();

        if(count($cities) == 0)
        {
            return redirect()->back()->with('error', 'Ne postoji grad koji sadrzi: ' . $cityName);
        }

        $userFavourites = Auth::check() ? Auth::user()->cityFavourite->pluck('city_id')->toArray() : [];

        return view('home', compact('cities', 'userFavourites'));
    }
}
