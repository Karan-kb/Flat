@foreach($flats as $flat)
    <div>
    <h2>Flat ID: {{ $flat->id }}</h2>
        <p>Location: {{ $flat->location }}</p>
        <p>Price: {{ $flat->price }}</p>
        <p>Water: {{ $flat->water }}</p> 
        <p>Transportation: {{ $flat->transportation }}</p> 

        <p>Number of rooms: {{ $flat->num_rooms }}</p>
        <p>Average rating: {{ $flat->calculate_average_rating() }}</p>
    </div>
@endforeach
