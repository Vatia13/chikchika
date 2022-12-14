<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Tweeted extends Notification implements ShouldQueue
{
    use Queueable;

    protected $tweet;
    protected $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tweet)
    {
        $this->tweet = $tweet;
        $this->message = 'The '.$tweet->user->username.' you are following has tweeted';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
                    ->line($this->message)
                    ->line($this->tweet->tweet)
                    ->action('Got to tweet', URL::route('tweet.view', $this->tweet->id));
    }


    /**
     * Save notification to database.
     *
     * @return Array
     */
    public function toDatabase()
    {
        return [
            'message' => $this->message,
            'tweet_id' => $this->tweet->id,
            'tweet' => $this->tweet->tweet,
            'user' => $this->tweet->user->username
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
