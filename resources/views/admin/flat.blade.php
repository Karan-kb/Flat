<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .div_center{
            text-align: center;
            padding-top:40px;
        }

        .font_size{
            font-size:40px;
            padding-bottom:40px;
        }

        .text_color{
            color:black;
            padding-bottom:20px;
        }

        label{
            display:inline-block;
            width:200px;

        }

        .div_design{
            padding-bottom:15px;

        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

          <div class="div_center">

          <h1 class="font_size">Add Flat</h1>

          <form id="myForm" action="{{url('/show_flat')}}" method="POST" enctype="multipart/form-data">

          @csrf
         
          <div class="div_design">
          <label>Flat Title :</label>
          <input class="text_color" type="text" name="title" placeholder="Title here" required="">

          </div>

    <div class="div_design">
          <label>Flat Description:</label>
          <input class="text_color" type="text" name="description" placeholder="Description here" required="">

    </div>

    <div class="div_design">
          <label>Flat Rent :</label>
          <input class="text_color" type="number" name="rent" placeholder="Rent here" required>

    </div>
    <div class="div_design">
  <label for="location">Flat Location Here:</label>
  <input class="text_color" type="text" name="location" id="location" placeholder="Flat location" required>
</div>

<div class="div_design">
  <label for="latitude">Latitude:</label>
  <input class="text_color" type="text" name="latitude" id="latitude" placeholder="Latitude" required>
</div>

<div class="div_design">
  <label for="longitude">Longitude:</label>
  <input class="text_color" type="text" name="longitude" id="longitude" placeholder="Longitude" required>
</div>


    <div class="div_design">
          <label>Phone :</label>
          <input class="text_color" type="number" name="phone" placeholder="Phone" required>

    </div>
    

    <div class="div_design">
          <label>Flat Category :</label>
          <select class="text_color" name="category" required="">
            <option value="" selected="">Add a category here</option>


            @foreach($category as $category)
            <option value="{{$category->category_name}}">{{$category->category_name}}</option>

            @endforeach
          </select>

    </div>
   


    <div class="div_design">
          <label>Flat Image Here :</label>
          <input type="file" name="image" required="">

    </div>


    <div class="div_design">
          
          <input type="submit" value="Add Flat" class="btn btn-primary">

    </div>

    </form>

</div>

</div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
  <script>
  // get the form element
  const myForm = document.getElementById('myForm');

  // add an event listener to the form
  myForm.addEventListener('submit', (event) => {
    // prevent the form from submitting if rent is negative
    const rentInput = myForm.querySelector('input[name="rent"]');
    if (rentInput.value < 0) {
      event.preventDefault();
      alert('Rent cannot be negative.');
    }
  });
    </script>
</html>

