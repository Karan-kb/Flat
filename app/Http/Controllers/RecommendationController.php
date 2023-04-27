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
            // Load user data excluding the authenticated user
            $users = User::whereNotIn('id', [$user->id])->get();
    
            // Load flat data
            $flats = Flat::all();
    
            // Generate recommendations
            $recommendations = array();
            foreach ($flats as $flat) {
                // Check if authenticated user has rated flat
                if (!$this->getUserFlatRating($user, $flat)) {
                    $score = $this->computeRecommendationScore($user, $flat, $users);
    
                    $recommendations[$flat->id] = $score;
                }
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
    
    private function computeRecommendationScore($user, $flat, $users)
{
    $sum = 0;
    $count = 0;
    foreach ($users as $otherUser) {
        // Check if the other user has rated the flat
        $rating = $this->getUserFlatRating($otherUser, $flat);
        if ($rating > 0) {
            // Check if the other user has rated any flats that the authenticated user has rated
            $otherUserRatings = DB::table('ratings')
                ->where('user_id', $otherUser->id)
                ->whereIn('flat_id', function ($query) use ($user) {
                    $query->select('flat_id')
                          ->from('ratings')
                          ->where('user_id', $user->id);
                })
                ->get();

            if ($otherUserRatings->count() > 0) {
                // Compute the similarity score between the other user and the authenticated user
                $similarity = 0;
                foreach ($otherUserRatings as $otherUserRating) {
                    $authenticatedUserRating = DB::table('ratings')
                        ->where('user_id', $user->id)
                        ->where('flat_id', $otherUserRating->flat_id)
                        ->value('water_rating');

                    $similarity += abs($otherUserRating->water_rating - $authenticatedUserRating);
                }
                $similarity = 1 / ($similarity + 1);

                // Weight the rating by the similarity score
                $sum += $similarity * $rating;
                $count += $similarity;
            }
        }
    }

    if ($count > 0) {
        $average_rating = $sum / $count;
        return $average_rating;
    } else {
        return 0;
    }
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