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
   </head>
   <style type="text/css">
      section.recommend_deg {
        position: relative;
        top: -400px; /* adjust the value as needed */
      }
   </style>
   <body>
   @include('home.header')
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Recommended Flats</h1>

        @if ($recommendations->isEmpty())
            <p>No recommendations found for this user.</p>
        @else
        <ul>
    @foreach ($recommendations as $recommendation)
        <li>
            <a href="{{ route('flats.show', $recommendation->flat->id) }}">
                {{ $recommendation->flat->name }} (Score: {{ $recommendation->score }})
            </a>
            @if ($recommendation->flat->ratings->isNotEmpty())
                <p>Your rating: {{ $recommendation->flat->ratings->first()->water_rating }}</p>
            @endif
        </li>
    @endforeach
</ul>

        @endif
    </div>
@endsection
</body>
</html>