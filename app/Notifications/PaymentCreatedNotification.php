<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class PaymentCreatedNotification extends Notification
{
    use Queueable;

    protected $payment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Payment Created!')
                    ->line('The invoice for this order #' .$this->payment->order->number.' has been successfully paid')
                    ->action('View Order', url(route('orders')))
                    ->line('Thank you for shopping wish us!');
    }

    public function toBroadCast($notifiable)
    {
        return [
            'title' => 'Payment Created!',
            'body' => 'The invoice for this order #' .$this->payment->order->number.' has been successfully paid',
            'icon' => '',
            'url' => url('order/'.$this->payment->order_id), 
            'time' => Carbon::now()->diffForHumans(),
        ];
    }

    
    public function toDataBase($notifiable)
    {
        return [
            'title' => 'Payment Created!',
            'body' => 'The invoice for this order #' .$this->payment->order->number.' has been successfully paid',
            'icon' => '',
            'url' => url('order/'.$this->payment->order_id), 
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
