<?php

use App\Http\Controllers\Api\v1\TweetsController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::name('user.')->controller(UserController::class)->group(function () {
            Route::get('/me', 'me')->name('details');
            Route::get('/{email}/profile', 'profile')->name('profile');
            Route::get('/following', 'following')->name('following');
            Route::get('/follows', 'followers')->name('followers');
            Route::post('/follow/{user_id}', 'follow')->name('follow');
            Route::delete('/unfollow/{user_id}', 'unfollow')->name('unfollow');
        });
    });

    Route::prefix('tweets')->name('tweets.')->controller(TweetsController::class)->group(function () {
        Route::get('/', 'feed')->name('feed');
        Route::post('/', 'create')->name('create');
        Route::get('/{email}/feed', 'feed')->name('user_feed');
        Route::get('/{tweet_id}', 'tweet')->name('tweet');
        Route::get('/{tweet_id}/replies', 'replies')->name('replies');
        Route::post('/{tweet_id}/like', 'like')->name('like');
        Route::delete('/{tweet_id}/unlike', 'unlike')->name('unlike');
        Route::delete('/{tweet_id}/delete', 'delete')->name('delete');
        Route::post('/{tweet_id}/reply', 'reply')->name('reply');
    });
});
