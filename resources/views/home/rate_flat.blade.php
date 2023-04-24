<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/public">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
    <title>Document</title>

    @include('home.header')
    <style>
        form {
  width: 80%;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

label {
  margin-top: 1rem;
  font-size: 1.2rem;
  font-weight: bold;
}

.rating {
  display: flex;
  flex-direction: row-reverse; /* changed from inline-flex */
  margin: 0.5rem 0;
}

.rating input[type="radio"] {
  display: none;
}

.rating label {
  position: relative;
  cursor: pointer;
  font-size: 2rem;
  color: #ddd;
  margin-right: 1rem;
}

.rating label:before {
  content: "\2606";
  position: absolute;
  top: 0;
  left: 0;
  font-size: 2rem;
}

.rating label:hover:before,
.rating label:hover ~ label:before,
.rating input[type="radio"]:checked ~ label:before {
  content: "\2605";
  color: #f90;
}

textarea {
  width: 100%;
  height: 8rem;
  padding: 0.5rem;
  margin-top: 1rem;
  border: 2px solid #ddd;
  font-size: 1.2rem;
  font-family: Arial, sans-serif;
}

button[type="submit"] {
  margin-top: 1rem;
  padding: 0.5rem 1rem;
  background-color: #f90;
  color: #fff;
  border: none;
  border-radius: 0.3rem;
  font-size: 1.2rem;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #f60;
}
.legend_class{
    text-align:center;
    color:black;
}

    </style>
</head>
<body>

<form action="{{url('/rate')}}" method="POST" enctype="multipart/form-data">

@csrf
<input type="hidden" name="flatID" value="{{$flat->id}}">
<legend class="legend_class">Rate this Flat</legend>
<div>
      <p style="color: tomato; font-weight: 700; font-size: 1.5rem">{{$flat->title}}</p>
    </div>
  <div>
    <label for="water-rating">Rating:</label>
    <div>
      
      <div class="rating">
        <input type="radio" id="water-rating-5" name="water_rating" value="5">
        <label for="water-rating-5">&#9733;</label>
        <input type="radio" id="water-rating-4" name="water_rating" value="4">
        <label for="water-rating-4">&#9733;</label>
        <input type="radio" id="water-rating-3" name="water_rating" value="3">
        <label for="water-rating-3">&#9733;</label>
        <input type="radio" id="water-rating-2" name="water_rating" value="2">
        <label for="water-rating-2">&#9733;</label>
        <input type="radio" id="water-rating-1" name="water_rating" value="1">
        <label for="water-rating-1">&#9733;</label>
      </div>
    </div>
  
    
  </div>
  <button type="submit">Submit</button>
</form><br/>



</body>
<div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
<footer>

</footer>
</html>