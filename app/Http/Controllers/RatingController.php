<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store($flat_id, $rating)
    {
        $user = Auth::user();

        // Check if the user has already rated this flat
        $existing_rating = Rating::where('user_id', $user->id)
            ->where('flat_id', $flat_id)
            ->first();

        if ($existing_rating) {
            // Update the existing rating
            $existing_rating->water_rating = $rating;
            $existing_rating->save();
        } else {
            // Create a new rating
            $new_rating = new Rating([
                'user_id' => $user->id,
                'flat_id' => $flat_id,
                'water_rating' => $rating,
            ]);
            $new_rating->save();
        }

        return redirect()->back();
    }
}
