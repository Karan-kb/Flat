<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flat;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;




class RatingController extends Controller
{
    /**
     * Show the form for creating a new rating.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function create(Flat $flat)
    {
        return view('ratings.create', compact('flat'));
    }

    /**
     * Store a newly created rating in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Retrieve the authenticated user's id
        $user = Auth::user();
    
        $validatedData = $request->validate([
            'water_rating' => 'required|integer|between:1,5',
            'location_rating' => 'required|integer|between:1,5',
            'price_rating' => 'required|integer|between:1,5',
            'transportation_rating' => 'required|integer|between:1,5',
            'cleanliness_rating' => 'required|integer|between:1,5',
            'flat_id' => 'required|exists:flats,id',
            'comment' => 'nullable|string|max:255',
        ]);
    
        // Create a new rating instance and associate it with the authenticated user
        $rating = new Rating($validatedData);
        $rating->user_id = $user_id;
        $rating->save();
    
    
        return redirect()->route('ratings.index')
            ->with('success', 'Rating created successfully.');
    }

}
