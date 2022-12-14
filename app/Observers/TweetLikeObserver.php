<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Tweet;
use App\Models\TweetLike;
use App\Notifications\Liked;

class TweetLikeObserver
{
    /**
     * Handle the TweetLike "created" event.
     *
     * @param  \App\Models\TweetLike  $tweetLike
     * @return void
     */
    public function created(TweetLike $tweetLike)
    {
        $tweet = Tweet::where('id', $tweetLike->tweet_id)->with('user')->first();
        $user = User::where('id', $tweetLike->user_id)->first();
        $tweet->user->notify(new Liked($user, $tweet));
    }
}
