<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <base href="/public">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Flat Rental System</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
     
         <!-- end slider section -->
      
      <!-- why section -->

      <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width:50%; padding:30px;">
                 
                     <div class="img-box">
                        <img src="flat/{{$flat->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5 style="color:black">
                           Title:{{$flat->title}}
                        </h5>
                        <h6 style="color:blue">
                        Rs.{{$flat->rent}}
                        </h6> 
                        <h8 style="color:black">
                           Category:{{$flat->category}}
                        </h8> <br />

                        <h8 style="color:black">
                           Phone:{{$flat->phone}}
                        </h8> <br />
                        
                        
                       
                    <h7 style="color:black">
                        Flat Details: {{$flat->description}}
                    </h7><br />

                    <form action="{{url('rent',$flat->id)}}" method="Post">
                              @csrf
                              <div class="row">
                                 <div class="col-md-4">
                              <input type="submit" value="Rent">
</div>

</div>
</form>

                    
                     </div>
                  </div>
                  
               </div>
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
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
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