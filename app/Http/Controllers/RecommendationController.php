<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Flat;
use App\Models\CosineSimilarity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    
    function getRecommendation(Request $request) {
        $ratingsModel = new Ratings();
        $flatModel = new flat();
        $similarityScoreModel = new SimilarityScores();

        $recommendationRating = [0, 0, 0, ];
        $recommendations = [0, 0, 0, ];

        $user_rating = $flatsModel->userRatings();
        $flatLocation = '';
        if($user_rating->count() <= 3) {
            request()->session()->flash('error', 'Please rate at least 3 flats.');
            return redirect()->route('home.userpage');
        } else {
            if($request->get('ward_enabled') == 0) {
                $flat = $flatModel->getFlatNoWard($request);
            } elseif ($request->get('ward_enabled') == 1) {
                $flat = $flatModel->getFlatWard($request);
            }

            foreach ($flat as $f) {
                $ratingEstimateNum = 0;
                $ratingEstimateDen = 0;
                foreach ($user_rating as $ur) {
                    if ($ur->flat == $f->flat) {
                        $ratingEstimateNum += $ur->rating;
                        $ratingEstimateDen += 1;
                    } elseif ($ur->flat < $f->flat) {
                        $ss = 0;
                        $ssCollection = $similarityScoreModel->getSimilarityScore($f->flat, $ur->flat);
                        foreach ($ssCollection as $s) {
                            $ss = $s->similarity_score;
                        }
                        $ratingEstimateNum = $ratingEstimateNum + $ur->rating * $ss;
                        $ratingEstimateDen += $ss;
                    } elseif ($ur->flat > $f->flat) {
                        $ss = 0;
                        $ssCollection = $similarityScoreModel->getSimilarityScore($ur->flat, $f->flat);
                        foreach ($ssCollection as $s) {
                            $ss = $s->similarity_score;
                        }
                        $ratingEstimateNum = $ratingEstimateNum + $ur->rating * $ss;
                        $ratingEstimateDen += $ss;
                    }
                }
                $ratingEstimate = $ratingEstimateNum / $ratingEstimateDen;
                if ($ratingEstimate >= $recommendationRating[0]) {
                    
                    $recommendationRating[2] = $recommendationRating[1];
                    $recommendationRating[1] = $recommendationRating[0];
                    $recommendationRating[0] = $ratingEstimate;
                    
                   
                    $recommendations[2] = $recommendations[1];
                    $recommendations[1] = $recommendations[0];
                    $recommendations[0] = $csl->flat;
                } elseif ($ratingEstimate >= $recommendationRating[1]) {
                    $recommendationRating[2] = $recommendationRating[1];
                    $recommendationRating[1] = $ratingEstimate;

                    $recommendations[2] = $recommendations[1];
                    $recommendations[1] = $f->flat;
                } elseif ($ratingEstimate >= $recommendationRating[2]) {
                    $recommendationRating[2] = $ratingEstimate;

                    $recommendations[2] = $f->location;
                }
            }
        }
        $ratingModel = new Ratings();
        $data['ratings'] = $provinceModel->selectRatings();
        $data['user'] = Auth::id();

        $data['recommendations'] = $flatModel->getFinalRecommendations($recommendations[0], $recommendations[1], $recommendations[2]);
        return view('recommend.recommend', compact('data'));
    }
}
