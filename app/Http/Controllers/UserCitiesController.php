<?php

namespace App\Http\Controllers;

use App\Models\UserCities;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserCitiesController extends Controller
{
    public function favourite(Request $request, $city)
    {
        $user = Auth::user();

        if($user === null)
        {
            return redirect()->back()->with('error', 'Morate biti ulogovani da bi oznacili grad.');
        }

        UserCities::create([
            'user_id' => Auth::id(),
            'city_id' => $city
        ]);

        return redirect()->back();
    }
}
