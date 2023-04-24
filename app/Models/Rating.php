<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'user_id',
        'flat_id',
        'water_rating',
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }

    public function getAverageRating()
    {
        $total = 0;
        $total += $this->water_rating;
        
        return $total / 5;
    }

    public static function getAverageRatingForFlat($flat_id)
    {
        $ratings = Rating::where('flat_id', $flat_id)->get();
        $total = 0;
        foreach ($ratings as $rating) {
            $total += $rating->getAverageRating();
        }
        return $total / count($ratings);
    }
}
