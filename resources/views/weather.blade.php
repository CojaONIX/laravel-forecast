@extends('layout')

@section('title', 'Weather')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>city</th>
                <th>temperature</th>
                <th>created_at</th>
                <th>updated_at</th>
            </tr>
        </thead>

        <tbody>
        @foreach($weathers as $weather)
            <tr>
                <td>{{ $weather->id }}</td>
                <td>{{ $weather->city->city }}</td>
                <td>{{ $weather->temperature }}</td>
                <td>{{ $weather->created_at }}</td>
                <td>{{ $weather->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
