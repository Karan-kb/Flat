<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Flat extends Model
{
    use HasFactory;
    protected $table = 'flats'
    ;

   

    protected $fillable = [
        'title',
        'latitude',
        'longitude',
        // other fields in your flats table
    ];

    public function getFlats()
   {
      return Flat::all();
   }

    public function users() {
        return $this->belongsToMany(User::class, 'ratings', 'user_id', 'flat_id')->withPivot(['water_rating', 'location_rating', 'price_rating', 'transportation_rating', 'cleanliness_rating']);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

}