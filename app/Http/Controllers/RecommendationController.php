<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Flat;
use Illuminate\Support\Facades\Auth;


class RecommendationController extends Controller
{

    public function generateRecommendations()
{
    // Get the currently authenticated user
    $user = Auth::user();

    // Only generate recommendations if there is an authenticated user
    if ($user) {
        // Load user data
        $users = User::all();

        // Load flat data
        $flats = Flat::all();

        // Compute user similarity
        $user_similarity = array();
        foreach ($users as $user1) {
            foreach ($users as $user2) {
                $similarity = $this->computeSimilarity($user1, $user2);
                $user_similarity[$user1->id][$user2->id] = $similarity;
            }
        }

        // Generate recommendations
        $recommendations = array();
        foreach ($flats as $flat) {
            $score = $this->computeRecommendationScore($user, $flat, $user_similarity);
            $recommendations[$flat->id] = $score;
        }

        // Sort recommendations by score in descending order
        arsort($recommendations);

        $top_n_recommendations = array();
        $counter = 0;
        foreach ($recommendations as $flat_id => $score) {
            if ($counter >= 6) {
                break;
            }
            $flat = Flat::find($flat_id);
            if ($flat) {
                $top_n_recommendations[$flat_id] = $flat;

                $counter++;
            }
        }

        // Return recommendations
        return view('home.recommendations')->with('recommendations', $top_n_recommendations);

    } else {
        // Redirect to login page if there is no authenticated user
        return redirect()->route('login');
    }
}

   private function computeSimilarity($user1, $user2)
    {
        // Get all the flats that both users have rated
        $common_flats = $user1->ratings()->whereIn('flat_id', $user2->ratings()->pluck('flat_id'))->get();

        // Check if there are any common flats
        if ($common_flats->count() === 0) {
            return 0;
        }

        // Calculate the sum of the ratings for each user
        $user1_sum = $common_flats->where('user_id', $user1->id)->sum('water_rating');
        $user2_sum = $common_flats->where('user_id', $user2->id)->sum('water_rating');

        // Calculate the sum of the squares of the ratings for each user
        $user1_squared_sum = $common_flats->where('user_id', $user1->id)->sum(function ($rating) {
            return pow($rating->water_rating, 2);
        });
        $user2_squared_sum = $common_flats->where('user_id', $user2->id)->sum(function ($rating) {
            return pow($rating->water_rating, 2);
        });

        // Calculate the sum of the product of the ratings for both users
        $product_sum = $common_flats->sum(function ($rating) use ($user1, $user2) {
            return $rating->water_rating * ($rating->user_id == $user1->id ? $user2->ratings()->where('flat_id', $rating->flat_id)->first()->water_rating : $user1->ratings()->where('flat_id', $rating->flat_id)->first()->water_rating);
        });

        // Calculate the Pearson correlation coefficient
        $numerator = $product_sum - ($user1_sum * $user2_sum / count($common_flats));
        $denominator = sqrt(($user1_squared_sum - pow($user1_sum, 2) / count($common_flats)) * ($user2_squared_sum - pow($user2_sum, 2) / count($common_flats)));
        $similarity = $denominator == 0 ? 0 : $numerator / $denominator;

        return $similarity;
    }

    private function computeRecommendationScore($user, $flat, $user_similarity)
{
    $score = 0;
    $count = 0;
    $rated_by_users = $flat->ratings()->pluck('user_id')->unique();
    foreach ($rated_by_users as $other_user_id) {
        $other_user = User::find($other_user_id);
        $similarity = $user_similarity[$user->id][$other_user_id] ?? 0;
        $other_user_rating = $this->getUserFlatRating($other_user, $flat);
        if ($similarity > 0 && $other_user_rating > 0) {
            $score += $similarity * $other_user_rating;
            $count++;
        }
    }
    $average_score = $count > 0 ? $score / $count : 0;
    return $average_score;
}


    private function getUserFlatRating($user, $flat)
    {
        $rating = DB::table('ratings')
            ->where('user_id', $user->id)
            ->where('flat_id', $flat->id)
            ->value('water_rating');
        return $rating ?? 0; // Return 0 if no rating is found

    }
}