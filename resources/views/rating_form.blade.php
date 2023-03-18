<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    

    <form action="{{ route('rating.store') }}" method="post">
        @csrf
        <!-- <label for="flatID">Choose an option:</label> -->
        <select name="flatID" id="flatID">
        @foreach($flats as $flat)
        <option value="{{$flat->id}}">{{$flat->title}}</option>
        @endforeach
        </select>
        <br><br>
        <input type="number" name="cleanliness_rating" id="cleanliness_rating" placeholder="cleanliness_rating">     <br><br>
        <input type="number" name="transportation_rating" placeholder="transportation_rating" id="transportation_rating">     <br><br>
        <input type="number" name="price_rating" id="price_rating" placeholder="price_rating">     <br><br>
        <input type="number" name="location_rating" id="location_rating" placeholder="location_rating">     <br><br>
        <input type="number" name="water_rating" id="water_rating" placeholder="water_rating">     <br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>