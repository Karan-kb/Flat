<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function index()
    {
        $flat = Flat::all();
        return view('home.userpage', compact('flat'));

        foreach ($flats as $flat) {
             //Get all ratings for this flat
            $flatRatings = $flat->ratings;

            //Display the flat's name and ratings
            echo $flat->name . ':';
            foreach ($flatRatings as $rating) {
                echo $rating->score . ' ';
            }
            echo '<br>';
        }
    }
}
