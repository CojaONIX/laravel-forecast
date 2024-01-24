@extends('layout')

@section('title', 'City Forecast')

@section('content')

    @if(isset($city))
        <h2>{{ ucwords($city) }}</h2>
        <hr>

        <ul>
        @foreach($cityForecast as $day => $t)
            <li>{{ $day }}: {{ $t }}</li>
        @endforeach
        </ul>
    @else
        <h2>Trazeni grad ne postoji!</h2>
    @endif


@endsection
