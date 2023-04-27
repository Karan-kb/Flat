<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      
      <title>Flat Rental System</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />

      <style type="text/css">

        .center{
            margin:auto;
            width: 50%;
            text-align:center;
            padding:30px;
        }

        table,th,td{
            border:1px solid grey;

        }

        .th_deg{
            font-size:30px;
            padding:5px;
            background:skyblue;
        }

        .img_deg{
            height:200px;
            width:200px;
        }
        .total_deg{
            font-size:20px;
            padding:40px;
        }

        </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
        <div class="center">

      <table>
        <tr>
   <th class="th_deg">Flat Title </th>
   <th class="th_deg">Rent </th>
   <th class="th_deg">Image </th>
   <th class="th_deg">Action </th>
   <!--<th class="th_deg">Rent duratition</th>-->

   
</tr>

<?php $totalrent=0;  ?>
@foreach($cart as $cart)
<tr>
    <td>{{$cart->flat_title}}</td>
    <td>Rs.{{$cart->rent}}</td>
    
    <td><img class="img_deg" src="/flat/{{$cart->image}}"></td>
    
    <td><a class="btn btn-danger" href="{{url('/remove_cart' ,$cart->id)}}">Remove Flat</a></td>

    <!--<td><div class="div_design">
   <-- <form method="POST" action="{{url('/store_rent_duration')}}">

                  <label>Rent Duration(years):</label>
                    <input class="text_color" type="number" name="rent_duration" placeholder="Rent duration" required>

    </div></td>-->
</tr>
<?php $totalrent= $totalrent + $cart->rent ?>

@endforeach




</table>

<div>
    <h1 class="total_deg">Total Rent: Rs.{{$totalrent}}</h1>

    </div>

    <div>
        <h1 style="font-size:25px; padding-bottom:15px;">Proceed To Rent</h1>

        <a href="{{url('cash_rent')}}" class="btn btn-danger">Cash Payment</a>

         <a href="{{url('stripe',$totalrent)}}" class="btn btn-danger">Pay Using Card</a>
    </div>


</div>


      <!-- why section -->

      
          <!-- end why section -->
         
      <!-- arrival section -->
      
      <!-- end arrival section -->
      
      <!-- product section -->
     
           <!-- end product section -->
        
      <!-- subscribe section -->
      
      <!-- end subscribe section -->
      <!-- client section -->
      
      <!-- end client section -->
      <!-- footer start -->
     
      <!-- footer end -->
      <div class="cpy_">
         
      </div>
      
      <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>