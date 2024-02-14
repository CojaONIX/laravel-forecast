@extends('layout')

@section('title', 'Home')

@section('content')

    <ul>
        @foreach($cities as $city)
            @php $icon = \App\Http\ForecastHelper::getIconByWeatherType($city->todaysForecastIcon->weather_type); @endphp
            <li>
                <a href="{{ route('forecast.city.page', ['city' => $city->city]) }}">
                    <i class="fa-solid fa-{{ $icon }} me-3"></i> {{ mb_convert_case($city->city, MB_CASE_TITLE, "UTF-8") }}
                </a>
            </li>
        @endforeach
    </ul>
    <hr>

    @if(\Illuminate\Support\Facades\Session::has('error'))
        <p class="text-danger">{{ \Illuminate\Support\Facades\Session::get('error') }}</p>
    @endif

    <form method="GET" action="{{ route('home.search') }}">
        <div class="form-floating col-3 mb-3">
            <input type="text" class="form-control" id="city" name="city" placeholder="City:" autofocus>
            <label for="city">City:</label>

        </div>

        <button class="btn btn-outline-primary col-3 my-3" type="submit">Nadji</button>
    </form>

@endsection
