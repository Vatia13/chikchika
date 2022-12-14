<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Replied extends Notification implements ShouldQueue
{
    use Queueable;


    protected $message;
    protected $reply;
    protected $repliedTo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reply, $repliedTo)
    {
        $this->reply = $reply;
        $this->repliedTo = $repliedTo;
        $this->message = $reply->user->username.' has replied to your tweet';
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
                    ->line("Reply: ". $this->reply->tweet)
                    ->action('go to your tweet', URL::route('tweet.view', $this->repliedTo->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'reply' => $this->reply->tweet,
            'your_tweet' => $this->repliedTo->tweet,
            'message' => $this->message
        ];
    }
}
