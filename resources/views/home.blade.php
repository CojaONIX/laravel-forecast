@extends('layout')

@section('title', 'Home')

@section('content')

    <ul>
        @foreach($cities as $city)
            <li><a href="/forecast/{{ $city->city }}">{{ mb_convert_case($city->city, MB_CASE_TITLE, "UTF-8") }}</a></li>
        @endforeach
    </ul>
    <hr>

    <form method="POST" action="">
        @csrf

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="city" name="city" placeholder="City:" autofocus>
            <label for="city">City:</label>

        </div>

        <button class="btn btn-outline-primary col-3 my-3" type="submit">Nadji</button>
    </form>

@endsection
