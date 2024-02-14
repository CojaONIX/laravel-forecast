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
        die('test');
    }
}
