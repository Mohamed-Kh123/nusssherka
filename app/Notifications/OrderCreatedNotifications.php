<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use \Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Support\Carbon;

class OrderCreatedNotifications extends Notification implements ShouldQueue
{
    use Queueable;

    


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected $order)
    {
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }


    public function viaQueues()
    {
        return [
            'mail' => 'orders',
            'broadcast' => 'orders',
            'database' => 'orders',
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
        $number = $this->order->number;
        return (new MailMessage)
                    ->subject('New Order #'.$number)
                    ->from('admin@store.com')
                    ->line("A new order has been created (Order #$number)")
                    ->action('View order', url('orders'))
                    ->line('Thank you for using our application!');
    }


    public function toDatabase($notifiable)
    {
        $number = $this->order->number;

        return [ 
          'title' => 'New Order #'.$number,
          'body' => "A new order has been created (Order #$number)",
          'icon' => '',
          'url' => url('orders'), 
        ];
    }

    // public function toVonage($notifiable)
    // {
    //     $number = $this->order->number;

    //     $message = new VonageMessage();
    //     $message->content("A new order has been created (Order #$number)");
    //     return $message;
    // }

    public function toBroadcast($notifiable)
    {
        $number = $this->order->number;
        return [ 
            'title' => 'New Order #'.$number,
            'body' => "New order has been created (Order #$number)",
            'icon' => '',
            'url' => url('order/'.$this->order->id), 
            'time' => Carbon::now()->diffForHumans(),
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
