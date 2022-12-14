<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Details about logged in user
     */
    public function me()
    {
        return Auth::user();
    }

    /**
     * User profile
     */
    public function profile(User $user, $username)
    {
        return $user->withCount('followers')
                    ->withCount('following')
                    ->isFollowedByMe()
                    ->where('username', $username)
                    ->first();
    }

    /**
     * returns the list of users that logged in user is following
     */
    public function following(User $user)
    {
        return $user->with(['following'])
                    ->findOrFail(Auth::user()->id)
                    ->following ?? [];
    }

    /**
     * returns the list of logged in user followers
     */
    public function followers(User $user)
    {
        return $user->with(['followers'])
                    ->findOrFail(Auth::user()->id)
                    ->followers ?? [];
    }

    /**
     * Follow the user
     */
    public function follow(User $user, $user_id)
    {
        if ($user_id != Auth::id()) {
            $user->findOrFail(Auth::id())
                 ->following()
                 ->attach($user_id);
        }
    }

    /**
     * Unfollow the user
     */
    public function unfollow(User $user, $user_id)
    {
        if ($user_id != Auth::id()) {
            $user->findOrFail(Auth::id())
                 ->following()
                 ->detach($user_id);
        }
    }
}
