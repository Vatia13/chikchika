<?php

namespace App\Observers;

use App\Models\Tweet;
use App\Notifications\Replied;
use App\Notifications\Tweeted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TweetObserver
{
    /**
     * Handle the Tweet "created" event.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return void
     */
    public function created(Tweet $tweet)
    {
        if ($tweet->tweet_id) {
            $repliedTo = Tweet::find($tweet->tweet_id);
            if ($repliedTo->user->id != Auth::id()) {
                $repliedTo->user->notify(new Replied($tweet, $repliedTo));
            }
            return;
        }
        Notification::send($tweet->user->followers, new Tweeted($tweet));
        return;
    }
}
