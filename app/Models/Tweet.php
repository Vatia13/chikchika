<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tweet extends Model
{
    use HasFactory;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tweet_id',
        'user_id',
        'tweet'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['created_at_for_humans'];

    /**
     * Get users feed data if their profile is public
     * Always show own tweets
     * In case of private profile display feed only for them who is following the user
     */
    public function scopeAvailableFeed($query)
    {
        $query->whereHas('user', function ($userQuery) {
            if (Auth::check()) {
                return $userQuery->whereHas('followers', function ($q) {
                    $q->where('follower_user_id', Auth::id());
                })->orWhere('is_public', 1)->orWhere('id', Auth::id());
            }
            return $userQuery->where('is_public', 1);
        });
    }

    /**
     * Get single user feed data
     */
    public function scopeUserFeed($query, $username)
    {
        if ($username) {
            $query->whereHas('user', function ($q) use ($username) {
                $q->where('username', $username);
            });
        }
    }

    /**
     * No replies
     */
    public function scopeNoReplies($query)
    {
        $query->where('tweet_id', null);
    }

    /**
     * Checks if logged in user is already liked this tweet and return 0/1
     */
    public function scopeIsLikedByMe($query)
    {
        if (Auth::check()) {
            $query->withCount(['likes', 'likes as your_like' => function ($q) {
                $q->where('likes.user_id', Auth::id());
            }]);
        }
    }

    /**
     * Get created_at datetime human readable
     */
    public function createdAtForHumans(): Attribute
    {
        return Attribute::make(get: fn () => $this->created_at->diffForHumans());
    }

    /**
     * Get tweet attribute
     */
    public function tweet(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Str::of($this->attributes['tweet'])
                        ->replaceMatches(
                            '/(?<!a href=\")(?<!src=\")((http|ftp)+(s)?:\/\/[^<>\s]+)/i',
                            function ($match) {
                                return '<a href="'.$match[0].'" target="_blank">'.$match[0].'</a>';
                            }
                        );
            }
        );
    }

    /**
     * Tweet user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Tweet replies
     */
    public function replies()
    {
        return $this->hasMany(Tweet::class, 'tweet_id', 'id');
    }

    /**
     * Tweet users likes
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'tweet_id', 'user_id')->using(TweetLike::class);
    }
}
