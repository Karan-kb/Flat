<?php

namespace App\Models;

use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Rating extends Model
{
    use HasFactory;
   
    function oldUserRating($request) {
        return DB::table('ratings')
            ->where('user', '=', Auth::id())
            ->where('flat', '=', $request->flat)
            ->get();
    }

    function getUserChargingStationRating($id) {
        return DB::table('ratings')
            ->join('flats', 'ratings.flat', '=', 'flat.id')
            
            ->select('ratings.id as r_id',
                'ratings.flat as r_fid',
                'flats.title as f_name',
                'ratings.rating as rating',
                
            )->where('ratings.user', '=', $id)
            ->get();
    }

    function insertRating($request) {
        $now = Carbon::now();

        DB::table('ratings')->insert([
            'user' => Auth::id(),
            'flat' => $request->get('flat'),
            'rating' => $request->get('rating'),
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }

    function userRatings() {
        return DB::table('ratings')
            ->select('id',
                'flat',
                'rating'
            )->where('ratings.user', '=', Auth::id())
            ->get();
    }

    function updateRating($request) {
        $now = Carbon::now();

        DB::table('ratings')
            ->where('user', '=', Auth::id())
            ->where('flat', '=', $request->flat)
            ->update([
                'rating' => $request->rating,
                'updated_at' => $now
            ]);
    }
}
