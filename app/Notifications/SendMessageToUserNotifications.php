<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendMessageToUserNotifications extends Notification implements ShouldQueue
{
    use Queueable;



    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected $notification)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function viaQueues()
    {
        return [
            'mail' => 'notification',
        ];
    }
    

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $admin = User::where('type', 'super-admin')->first();
        return (new MailMessage)
        ->subject($this->notification->data['title'])
        ->from($admin->email)
        ->line($this->notification->data['body'])
        ->action($this->notification->data['action'], $this->notification->data['url']);
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
