@php use App\Http\ForecastHelper; @endphp

@extends('layout')

@section('title', 'Home')

@section('content')

    <div class="col-md-6">
        <table class="table">
            @foreach($cities as $city)
                @php $icon = ForecastHelper::getIconByWeatherType($city->todaysForecastType->weather_type); @endphp
                <tr>
                    <td class="text-center">
                        <a href="{{ route('user.cities.unfavourite', ['city' => $city->id]) }}">
                            <i class="fa-solid fa-heart text-danger btn me-3"></i>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('forecast.city.page', ['city' => $city->city]) }}">
                            {{ mb_convert_case($city->city, MB_CASE_TITLE, "UTF-8") }}
                        </a>
                    </td>

                    <td class="text-center">
                        <i class="fa-solid fa-{{ $icon }} text-primary"></i>
                    </td>

                    <td class="text-end">
                        {{ $city->todaysForecastType->temperature }}&#8451;
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
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
