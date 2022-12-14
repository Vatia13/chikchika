<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WeeklySummery extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->message = "For the past 1 week you followed ".$user->following_count." ".Str::plural('user', $user->following_count).", ".$user->followers_count." ".Str::plural('user', $user->followers_count)." followed you.";
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
                    ->line('Thank you for using our application!');
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
            'user' => $notifiable,
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
