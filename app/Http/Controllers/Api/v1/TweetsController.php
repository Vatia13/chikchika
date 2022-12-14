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
     * we should receive user $username
     */
    public function feed(Tweet $tweet, $username = null)
    {
        return $tweet->availableFeed()
                    ->noReplies()
                    ->userFeed($username)
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
        return $tweet->availableFeed()
                     ->with('user')
                     ->withCount('likes')
                     ->withCount('replies')
                     ->isLikedByMe()
                     ->find($tweet_id);
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
        return $tweet
        ->where('tweet_id', $tweet_id)
        ->with('user')
        ->withCount('likes')
        ->isLikedByMe()
        ->latest()
        ->paginate();
    }

    /**
     * reply to tweet
     */
    public function reply(TweetRequest $request, Tweet $tweet, $tweet_id)
    {
        return $tweet->find($tweet_id)->replies()->create($request->validated());
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
     * delete own tweet
     */
    public function delete(Tweet $tweet, $tweet_id)
    {
        $tweet->where('user_id', Auth::id())->find($tweet_id)->delete();
    }
}
