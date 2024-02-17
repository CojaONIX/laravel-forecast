@php use App\Http\ForecastHelper; @endphp

@extends('layout')

@section('title', 'Home')

@section('content')

    <div class="col-md-8">
        <table class="table">
            @foreach($cities as $city)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('user.cities.unfavourite', ['city' => $city->city->id]) }}">
                            <i class="fa-solid fa-heart text-danger btn me-3"></i>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('forecast.city.page', ['city' => $city->city]) }}">
                            {{ mb_convert_case($city->city->city, MB_CASE_TITLE, "UTF-8") }}, {{ $city->city->country }}
                        </a>
                    </td>

                    <td class="text-center">
                        <img src="{{ $city->city->weather->icon }}" height="30px">
                    </td>

                    <td class="text-end">
                        {{ $city->city->weather->temperature }}&#8451;
                    </td>

                    <td>
                        {{ $city->city->weather->updated_at }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <hr>

    <form method="GET" action="{{ route('home.geolocation') }}">
        <button class="btn btn-outline-secondary col-3 my-3" type="submit">Geolocation</button>
    </form>

    <form method="GET" action="{{ route('home.search') }}">
        <div class="form-floating col-3 mb-3">
            <input type="text" class="form-control" id="city" name="city" placeholder="City:" value="{{ Session::get('city') }}" autofocus>
            <label for="city">City:</label>

        </div>

        <button class="btn btn-outline-primary col-3 my-3" type="submit">Search</button>

        @if(Session::has('error'))
            <p class="text-danger">{{ Session::get('error') }}</p>
        @endif
    </form>

@endsection
