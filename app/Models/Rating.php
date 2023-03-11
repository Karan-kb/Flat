<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
}


class Rating extends Model
{
    // Define a many-to-one relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define a many-to-one relationship with the Flat model
    
}