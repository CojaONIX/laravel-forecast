@extends('layout')

@section('title', 'Home')

@section('content')

    <ul>
        @foreach($cities as $city)
            <li><a href="/forecast/{{ $city->city }}">{{ mb_convert_case($city->city, MB_CASE_TITLE, "UTF-8") }}</a></li>
        @endforeach
    </ul>
    <hr>

    <form action="">
        <div>
            <input type="text" name="city" placeholder="Unesite ime grada">
        </div>
        <button type="submit">Pronadji</button>
    </form>

@endsection
