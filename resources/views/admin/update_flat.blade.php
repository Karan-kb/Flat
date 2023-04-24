<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
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

          <h1 class="font_size">Update Flat</h1>

          <form id="myForm" action="{{url('/update_flat_confirm',$flat->id)}}" method="POST" enctype="multipart/form-data">

          @csrf
         
          <div class="div_design">
          <label>Flat Title :</label>
          <input class="text_color" type="text" name="title" placeholder="Title here" required="" value="{{$flat->title}}">

          </div>

    <div class="div_design">
          <label>Flat Description:</label>
          <input class="text_color" type="text" name="description" placeholder="Description here" required="" value="{{$flat->description}}">

    </div>

    <div class="div_design">
          <label>Flat Rent :</label>
          <input class="text_color" type="number" name="rent" placeholder="Rent here" required="" value="{{$flat->rent}}">

    </div>
    <div class="div_design">
      <label for="location">Flat Location Here :</label>
      <input class="text_color" type="text" name="location" id="location" placeholder="Flat location" value="{{$flat->location}}">
    </div>
    

    <div class="div_design">
          <label>Flat Category :</label>
          <select class="text_color" name="category" required="">
            <option value="{{$flat->category}}" selected="">{{$flat->category}}</option>
            @foreach($category as $category)
            <option value="{{$category->category_name}}">{{$category->category_name}}</option>

            @endforeach

           
          </select>

    </div>
    <div class="div_design">
      <label for="location">Phone :</label>
      <input class="text_color" type="text" name="phone" id="tenants_quantity" placeholder="Tenants Quantity" required="" value="{{$flat->phone}}"> 
    </div>

    <div class="div_design">
          <label>Current Flat Image :</label>
          <img style="margin:auto;" height="100" width="100" src="/flat/{{$flat->image}}">

    </div>

    <div class="div_design">
          <label>Change Flat Image :</label>
          <input type="file" name="image">

    </div>


    <div class="div_design">
          
          <input type="submit" value="Update Flat" class="btn btn-primary">

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

