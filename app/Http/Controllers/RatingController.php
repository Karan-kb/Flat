<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flat;
use App\Models\Rating;


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
    public function store(Request $request, Flat $flat)
    {
        $request->validate([
            'score' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $rating = new Rating;
        $rating->score = $request->score;
        $rating->comment = $request->comment;
        $rating->flat_id = $flat->id;
        $rating->user_id = auth()->user()->id;
        $rating->save();

        return redirect()->route('flats.show', $flat)->with('success', 'Rating added successfully!');
    }

    public function update(Request $request, Rating $rating)
    {
        $request->validate([
            'score' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $rating->score = $request->score;
        $rating->comment = $request->comment;
        $rating->save();

        return redirect()->back()->with('success', 'Rating updated successfully!');
    }
}
