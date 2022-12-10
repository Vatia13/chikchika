<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_public'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * Check if user is followed by logged in user
     */
    public function scopeIsFollowedByMe($query)
    {
        if (Auth::check()) {
            $query->withCount(['followers', 'followers as is_followed_by_me' => function ($q) {
                $q->where('follower_user_id', Auth::id());
            }]);
        }
    }

    /**
     * User following
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_user_id', 'following_user_id');
    }

    /**
     * User followers
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'follower_user_id');
    }

    /**
     * User tweets
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class, 'tweet_id', 'user_id');
    }
}
