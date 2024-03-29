<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\UserCities;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserCitiesController extends Controller
{
    public function favourite($city)
    {
        if(!Auth::check())
        {
            return redirect()->back()->with('error', 'Morate biti ulogovani da bi oznacili grad.');
        }

        UserCities::create([
            'user_id' => Auth::id(),
            'city_id' => $city
        ]);

        return redirect()->back();
    }

    public function unfavourite($city)
    {
        UserCities::where(['user_id' => Auth::id(), 'city_id' => $city])->delete();

//        if(UserCities::where(['city_id' => $city])->count() == 0)
//        {
//            City::where(['id' => $city])->delete();
//        }

        return redirect()->back();
    }
}
