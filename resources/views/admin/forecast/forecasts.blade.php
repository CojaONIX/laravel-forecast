@extends('layout')

@section('title', 'Admin Forecasts')

@section('content')

    <form method="POST" action="{{ route('admin.forecasts.create') }}">
        @csrf

        <div class="row col-6">
            <div class="col-6">
                <select name="city_id" class="form-select mb-3">
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <input type="text" name="temperature" class="form-control mb-3" placeholder="Unesite temperaturu">
            </div>
        </div>

        <div class="row col-md-6">
            <div class="col-4">
                <select name="weather_type" class="form-select mb-3">
                    @foreach(\App\Models\Forecast::WEATHERS as $weather)
                        <option value="{{ $weather }}">{{ $weather }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-4">
                <input type="text" name="probability" class="form-control mb-3" placeholder="% verovatnoce za padavine">
            </div>
            <div class="col-4">
                <input type="date" name="date" class="form-control mb-3"
                       value="{{ \Illuminate\Support\Carbon::now()->format('Y-m-d') }}">
            </div>

            <button class="btn btn-outline-primary col-12 my-3" type="submit">Save</button>
        </div>
    </form>

    <div class="d-flex flex-wrap">
        @foreach($cities as $city)
            <div class="mb-5 mx-2">
                <h4>{{ $city->city }}</h4>
                <ul class="list-group">
                    @foreach($city->forecasts as $forecast)

                        @php
                            $color = \App\Http\ForecastHelper::getColorByTemperature($forecast->temperature);
                            $icon = \App\Http\ForecastHelper::getIconByWeatherType($forecast->weather_type);
                        @endphp

                        <li class="list-group-item">{{ $forecast->date }} - <span  style="color:{{ $color }};">{{ $forecast->temperature }}</span> - <i class="fa-solid fa-{{ $icon }}"></i> - {{ $forecast->probability }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach

    </div>

@endsection
