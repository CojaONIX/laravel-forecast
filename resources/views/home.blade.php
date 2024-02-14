@php use App\Http\ForecastHelper; @endphp

@extends('layout')

@section('title', 'Home')

@section('content')

    <ul>
        @foreach($cities as $city)
            @php $icon = ForecastHelper::getIconByWeatherType($city->todaysForecastType->weather_type); @endphp
            <li>
                <a href="{{ route('user.cities.favourite', ['city' => $city->id]) }}"><i class="fa-regular fa-heart text-danger btn me-3"></i></a>
                <a href="{{ route('forecast.city.page', ['city' => $city->city]) }}">
                    <i class="fa-solid fa-{{ $icon }} me-3"></i>{{ mb_convert_case($city->city, MB_CASE_TITLE, "UTF-8") }}
                </a>
            </li>
        @endforeach
    </ul>
    <hr>

    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    <form method="GET" action="{{ route('home.search') }}">
        <div class="form-floating col-3 mb-3">
            <input type="text" class="form-control" id="city" name="city" placeholder="City:" autofocus>
            <label for="city">City:</label>

        </div>

        <button class="btn btn-outline-primary col-3 my-3" type="submit">Search</button>
    </form>

@endsection
