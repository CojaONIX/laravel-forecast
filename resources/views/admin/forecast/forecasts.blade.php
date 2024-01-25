@extends('layout')

@section('title', 'Admin Forecasts')

@section('content')

    <form method="POST" action="{{ route('admin.forecasts.create') }}">
        @csrf

        <select name="city_id">
            @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->city }}</option>
            @endforeach
        </select>
        <input type="text" name="temperature" placeholder="Unesite temperaturu">

        <select name="weather_type">
            <option value="sunny">sunny</option>
            <option value="rainy">rainy</option>
            <option value="snowy">snowy</option>
        </select>

        <input type="text" name="probability" placeholder="% verovatnoce za padavine">
        <input type="date" name="date">

        <button>Snimi</button>
    </form>

    @foreach($cities as $city)
        <h4>{{ $city->city }}</h4>
        <ul>
        @foreach($city->forecasts as $forecast)
            <li>{{ $forecast->date }} - {{ $forecast->temperature }} - {{ $forecast->weather_type }} - {{ $forecast->probability }}</li>
        @endforeach
        </ul>
    @endforeach


@endsection
