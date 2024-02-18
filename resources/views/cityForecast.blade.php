@extends('layout')

@section('title', 'City Forecast')

@section('content')

    <h4>Sunrise: {{ $sunrise }}</h4>
    <h4>Sunset: {{ $sunset }}</h4>

    @if(isset($cityForecasts))
        <h2>{{ ucwords($cityForecasts->city) }}</h2>
        <hr>

        <ul>
            @foreach($cityForecasts->forecasts as $cityForecast)
                <li>date: {{ $cityForecast->date }} - temperature: {{ $cityForecast->temperature }}</li>
            @endforeach
        </ul>
    @elseif(isset($city))
        <h2>{{ ucwords($city->city) }}</h2>
        <hr>

        <ul>
            @foreach($city->forecasts as $forecast)
                <li>date: {{ $forecast->date }} - temperature: {{ $forecast->temperature }}</li>
            @endforeach
        </ul>
    @else
        <h2>Trazeni grad ne postoji!</h2>
    @endif


@endsection
