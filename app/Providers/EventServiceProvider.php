<?php

namespace App\Providers;

use App\Models\Tweet;
use App\Models\TweetLike;
use App\Models\UserFollow;
use App\Observers\TweetObserver;
use App\Observers\TweetLikeObserver;
use App\Observers\UserFollowObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        UserFollow::observe(UserFollowObserver::class);
        TweetLike::observe(TweetLikeObserver::class);
        Tweet::observe(TweetObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
