<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Requests\TweetRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    /**
     * returns the feed
     * in case of single user profile view
     * we should receive user $email
     */
    public function feed(Tweet $tweet, $email = null)
    {
        return $tweet->availableFeed($email)
                    ->userFeed($email)
                    ->with('user')
                    ->withCount('likes')
                    ->withCount('replies')
                    ->isLikedByMe()
                    ->latest()
                    ->paginate();
    }

    /**
     * returns a single tweet
     */
    public function tweet(Tweet $tweet, $tweet_id)
    {
        return $tweet->with(['replies'])->find($tweet_id);
    }

    /**
     * create a tweet
     */
    public function create(TweetRequest $request, Tweet $tweet)
    {
        return $tweet->create($request->validated());
    }

    /**
     * returns tweet replies
     */
    public function replies(Tweet $tweet, $tweet_id)
    {
        return $tweet->with(['replies'])->find($tweet_id)->replies ?? [];
    }

    /**
     * reply to tweet
     */
    public function reply(Tweet $tweet, $tweet_id)
    {
        return ['reply'];
    }

    /**
     * like tweet
     */
    public function like(Tweet $tweet, $tweet_id)
    {
        $tweet->find($tweet_id)->likes()->attach(Auth::id());
    }

    /**
     * unlike/dislike tweet
     */
    public function unlike(Tweet $tweet, $tweet_id)
    {
        $tweet->find($tweet_id)->likes()->detach(Auth::id());
    }

    /**
     * delete tweet
     */
    public function delete(Tweet $tweet, $tweet_id)
    {
        $tweet->find($tweet_id)->delete();
    }
}
