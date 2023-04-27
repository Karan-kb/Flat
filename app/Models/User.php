<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Rating;
use App\Models\Recommendation;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the flats that belong to the user.
     */
    public function flats()
    {
        return $this->belongsToMany(Flat::class, 'ratings', 'user_id', 'flat_id')->withPivot(['water_rating', 'location_rating', 'price_rating', 'transportation_rating', 'cleanliness_rating']);
    }

    /**
     * Get the ratings that belong to the user.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get the flats that have been rated by both the user and the other user.
     *
     * @param  User  $otherUser
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCommonRatedFlats(User $otherUser)
    {
        $userFlatIds = $this->ratings()->pluck('flat_id');
        $otherUserFlatIds = $otherUser->ratings()->pluck('flat_id');

        return Flat::whereIn('id', $userFlatIds)->whereIn('id', $otherUserFlatIds)->get();
    }

    public function getFlatRating($flat_id)
    {
        $rating = $this->ratings()->where('flat_id', $flat_id)->first();
        return $rating ? $rating->value : 0;
    }
    public function hasRatedFlat($flat)
    {
        return $this->ratings()->where('flat_id', $flat->id)->exists();
    }
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

}