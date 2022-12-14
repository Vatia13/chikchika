<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserFollow;
use App\Notifications\Followed;
use App\Notifications\Unfollowed;

class UserFollowObserver
{
    /**
     * Handle the UserFollow "created" event.
     *
     * @param  \App\Models\UserFollow  $userFollow
     * @return void
     */
    public function created(UserFollow $userFollow)
    {
        $followerUser = User::where('id', $userFollow->follower_user_id)->first();
        $followingUser = User::where('id', $userFollow->following_user_id)->first();
        $followingUser->notify(new Followed($followerUser->username));
    }

    /**
     * Handle the UserFollow "deleted" event.
     *
     * @param  \App\Models\UserFollow  $userFollow
     * @return void
     */
    public function deleted(UserFollow $userFollow)
    {
        $followerUser = User::where('id', $userFollow->follower_user_id)->first();
        $followingUser = User::where('id', $userFollow->following_user_id)->first();
        $followingUser->notify(new Unfollowed($followerUser->username));
    }
}
