<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('home', compact('cities'));
    }
    public function search(Request $request)
    {
        $cityName = $request->get('city');
        $cities = City::where('city', 'LIKE', '%'.$cityName.'%')->get();

        return view('home', compact('cities'));
    }
}
