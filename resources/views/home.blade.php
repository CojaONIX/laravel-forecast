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
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="city" id="city" placeholder="Unesite ime grada">
            <label for="city">City:</label>
        </div>
        <button class="btn btn-outline-primary" type="submit">Pronadji</button>
    </form>

@endsection
