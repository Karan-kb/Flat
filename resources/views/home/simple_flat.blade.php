<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search flat</title>
</head>
<body>
    <h1>search by either location or rate
</h1>
<form action="{{ route('recommend') }}"  method="post">
@csrf
    <label>
  <input type="radio" name="search_type" value="rent">
  rent
</label>
<label>
  <input type="radio" name="search_type" value="location">
  Location
</label>
    <input type="text" id="search" name="search">
</form>
</body>
</html>