<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Flat extends Model
{
    use HasFactory;
}

class Flat extends Model
{
    // Define a one-to-many relationship with the Rating model
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
{
    return $this->ratings()->avg('score');
}

}

