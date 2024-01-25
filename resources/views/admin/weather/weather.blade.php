@extends('layout')

@section('title', 'Admin Weather')

@section('content')

    <form action="">
        <input type="text" name="temperature" placeholder="Unesite temperaturu">
        <select name="city_id">
            @foreach(\App\Models\City::all() as $city)
                <option value="{{ $city->id }}">{{ $city->city }}</option>
            @endforeach
        </select>
        <button>Snimi</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>city</th>
            <th>city_id</th>
            <th>temperature</th>
        </tr>
        </thead>

        <tbody>
        @foreach(\App\Models\Weather::all() as $weather)
            <tr>
                <td>{{ $weather->id }}</td>
                <td>{{ $weather->city->city }}</td>
                <td>{{ $weather->city->id }}</td>
                <td>{{ $weather->temperature }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
