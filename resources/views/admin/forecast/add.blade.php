@extends('layout')

@section('title', 'Admin - addForecast')

@section('content')

    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('admin.forecast.create') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City:" autofocus value="{{ old('city') }}">
                    <label for="city">City:</label>
                    @error('city')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form col-6">
                    <label for="temperature">Temperature:</label>
                    <input type="text" class="form-control" id="temperature" name="temperature" value="{{ old('temperature') }}">
                    @error('temperature')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn btn-outline-primary col-12 my-3" type="submit">Save</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

        </div>

@endsection
