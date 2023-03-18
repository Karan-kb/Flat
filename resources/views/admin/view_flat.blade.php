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
            padding-top:40px;
        }

        .img_size{
            width:150px;
            width:150px;
            }
        .th_color{
            background= black;
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
          <div class="content-wrappers">


          <h2 class="font_size">Flats</h2>
            <table class="center">
                <tr>
                    <th>Flat Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Flat Rent</th>
                    <th>Image</th>
                    <th>Location</th>
</tr>
@foreach($flat as $flat)
<tr class="th_color">
    <td >{{$flat->title}}</td>
    <td>{{$flat->description}}</td>
    <td>{{$flat->category}}</td>
    <td>{{$flat->rent}}</td>
    <td><img class="img_size" src="/flat/{{$flat->image}}"></td>
    <td>{{$flat->location}}</td>
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

