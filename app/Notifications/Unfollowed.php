<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Unfollowed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $followerUsername;
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($followerUsername)
    {
        $this->followerUsername = $followerUsername;
        $this->message = $this->followerUsername.' has unfollowed you';
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
                    ->action($this->followerUsername, URL::route('profile.view', $this->followerUsername));
    }

    /**
     * Save notification to database.
     *
     * @param  mixed  $notifiable
     * @return Array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'username' => $this->followerUsername
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
