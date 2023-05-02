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
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
      <!-- font awesome style -->
      <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
   </head>
   <style type="text/css">
      section.recommend_deg {
        position: relative;
        top: -400px; /* adjust the value as needed */
      }
   </style>
   <body>
   @include('home.header')
   <div class="row">
@foreach($recommendations as $flat)
    <div class="col-sm-6 col-md-4 col-lg-4">
        <div class="box">
            <div class="option_container">
                <div class="options">
                    <a href="{{ url('rate_flat', $flat->id) }}" class="option1">
                        Rate this flat
                    </a>
                    <a href="{{ url('flat_details', $flat->id) }}" class="option1">
                        Flat Details
                    </a>
                    <form action="{{ url('rent', $flat->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="submit" value="Rent">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="img-box">
                <img src="{{ asset('flat/'.$flat->image) }}" alt="">
            </div>
            <div class="detail-box">
                <h5>
                    {{ $flat->title }}
                </h5> 
                <h6>
                    Rs.{{ $flat->rent }}
                </h6>
            </div>
        </div>
    </div>
@endforeach
</div>
   </body>
</html>
