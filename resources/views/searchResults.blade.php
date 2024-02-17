@php use App\Http\ForecastHelper; @endphp

@extends('layout')

@section('title', 'Search Results')

@section('content')

    <div class="col-md-6">
        <table class="table">
        @foreach($cities as $city)
            <tr>
                <td class="text-center">
                    @if(in_array($city->id, $userFavourites))
                        <a href="{{ route('user.cities.unfavourite', ['city' => $city->id]) }}">
                            <i class="fa-solid fa-heart text-danger btn me-3"></i>
                        </a>
                    @else
                        <a href="{{ route('user.cities.favourite', ['city' => $city->id]) }}">
                            <i class="fa-regular fa-heart text-danger btn me-3"></i>
                        </a>
                    @endif
                </td>

                <td>
                    <a href="{{ route('forecast.city.page', ['city' => $city->city]) }}">
                        {{ mb_convert_case($city->city, MB_CASE_TITLE, "UTF-8") }}, {{ $city->country }}
                    </a>
                </td>

            </tr>
        @endforeach
        </table>
    </div>

    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    <a class="btn btn-outline-primary col-3 my-3" href="{{ route('home.page') }}">OK</a>

@endsection
