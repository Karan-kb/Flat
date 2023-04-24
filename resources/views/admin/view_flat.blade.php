<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">

        .center{
            margin:auto;
            width:50%;
            border:2px solid white; 
            text-align:center;
            margin-top:40px;
        }

        .font_size{
            text-align:center;
            font-size: 40px;
            padding-top:20px;
        }

        .img_size{
          max-width:100px;
          height:100px;
         
            
            }
        .th_color{
            background:skyblue;
        }
        
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">


          <h2 class="font_size">Flats</h2>

            <table class="center">

                <tr class="th_color">
                    <th>Flat Title</th>
                    <th>Description</th>
                    <th >Category</th>
                    <th>Flat Rent</th>
                    <th>Phone</th>
                    <th>Image</th>
                    <th>Location</th>
                    <th>Delete </th>
                    <th>Edit</th>  
                </tr>
@foreach($flat as $flat)
<tr>
    <td >{{$flat->title}}</td>
    <td>{{$flat->description}}</td>
    <td>{{$flat->category}}</td>
   
    <td>{{$flat->rent}}</td>
    <td>{{$flat->phone}}</td>
  
    <td><img class="img_size" src="/flat/{{$flat->image}}"></td>
    <td>{{$flat->location}}</td>
    <td>
      <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this flat?')" href="{{url('delete_flat',$flat->id)}}">Delete</a>
    </td>
    <td>
    <a class="btn btn-success" href="{{url('update_flat',$flat->id)}}">Edit</a>
    </td>
</tr>
@endforeach
</table>

</div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>

