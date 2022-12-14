<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Liked extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $tweet;
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $tweet)
    {
        $this->user = $user;
        $this->tweet = $tweet;
        $this->message = $user->username.' liked your tweet';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->action('Your Tweet', URL::route('tweet.view', $this->tweet->id));
    }

   /**
     * Save notification to database.
     *
     * @return Array
     */
    public function toDatabase()
    {
        return [
            'user' => $this->user->username,
            'tweet_id' => $this->tweet->id,
            'tweet' => $this->tweet->tweet,
            'message' => $this->message
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
