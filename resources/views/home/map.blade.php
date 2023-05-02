

@extends('layouts.app')

@section('content')
<form action="{{ url('/showMap', $flat->id) }}" method="GET">
    @csrf
    <div class="container">
        <h1>Flats Map</h1>
        <iframe width="100%" height="500" frameborder="0" style="border:0"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCF4bJUsewAdOowY_IgYG7gECOQc7hPIZk
                    &q={{ $flat->latitude }},{{ $flat->longitude }}">
        </iframe>
        
        <!-- Add markers for all flats except the current one -->
        @foreach ($flats as $flat)
            <marker position="{{ $flat->latitude }},{{ $flat->longitude }}"></marker>
        @endforeach
    </div>
</form>
@endsection
