@foreach($flats as $flat)
    <div>
        <h2>{{ $flat->name }}</h2>
        <p>Address: {{ $flat->address }}</p>
        <p>Average rating: {{ $flat->averageRating() }}</p>
    </div>
@endforeach
