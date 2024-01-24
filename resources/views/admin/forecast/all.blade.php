@extends('layout')

@section('title', 'Admin Forecast')

@section('content')
    <div class="d-flex justify-content-between align-items-start">
        <a href="{{ route('admin.forecast.add.page') }}" class="btn btn-primary">New Forecast</a>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>city</th>
            <th>temperature</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach($forecasts as $forecast)
            <tr>
                <td>{{ $forecast->id }}</td>
                <td>{{ $forecast->city }}</td>
                <td>{{ $forecast->temperature }}</td>
                <td>{{ $forecast->created_at }}</td>
                <td>{{ $forecast->updated_at }}</td>
                <td>
                    <div class="d-flex justify-content-between">
                        <form method="post" action="{{ route('admin.forecast.delete', ['forecast'=>$forecast->id]) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger" type="submit">Delete</button>
                        </form>

                        <a href="{{ route('admin.forecast.edit.page', ['forecast' => $forecast->id]) }}" class="btn btn-outline-primary">Edit</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
