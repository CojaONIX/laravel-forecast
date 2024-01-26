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
            @foreach(\App\Models\Forecast::WEATHERS as $weather)
                <option value="{{ $weather }}">{{ $weather }}</option>
            @endforeach
        </select>

        <input type="text" name="probability" placeholder="% verovatnoce za padavine">
        <input type="date" name="date">

        <button>Snimi</button>
    </form>

    @foreach($cities as $city)
        <h4>{{ $city->city }}</h4>
        <ul>
        @foreach($city->forecasts as $forecast)

            @php
                $color = null;
                if($forecast->temperature <= 0)
                    {
                        $color = 'lightblue';
                    }
                elseif($forecast->temperature <= 15)
                    {
                        $color = 'blue';
                    }
                elseif($forecast->temperature <= 25)
                    {
                        $color = 'green';
                    }
                else
                    {
                        $color = 'red';
                    }
            @endphp

            <li>{{ $forecast->date }} - <span style="color:{{ $color }};">{{ $forecast->temperature }}</span> - {{ $forecast->weather_type }} - {{ $forecast->probability }}</li>
        @endforeach
        </ul>
    @endforeach


@endsection
