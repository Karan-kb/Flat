<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function index()
    {
        $flats = Flat::all();
        return view('flat-listing', ['flats' => $flats]);

        foreach ($flats as $flat) {
            // Get all ratings for this flat
            $flatRatings = $flat->ratings;

            // Display the flat's name and ratings
            echo $flat->name . ':';
            foreach ($flatRatings as $rating) {
                echo $rating->score . ' ';
            }
            echo '<br>';
        }
    }
}
