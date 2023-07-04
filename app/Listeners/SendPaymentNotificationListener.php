<?php

namespace App\Listeners;

use App\Events\PaymentCreated;
use App\Models\User;
use App\Notifications\PaymentCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendPaymentNotificationListener
{
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PaymentCreated $event)
    {
        $payment = $event->payment;
        
        $users = User::where('type', '=', 'super-admin')->get();

        foreach($users as $user){
            $user->notify(new PaymentCreatedNotification($payment));
        }

        Notification::route('mail', $payment->order->billing_email)->notify(new PaymentCreatedNotification($payment));
    }
}
