<?php

namespace App\Listeners;

use App\Events\PaymentCreated;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeOrderPaymentStatusListnere
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
        // $payment = $event->payment;
        // $order = Order::where('id', $payment->order_id)->first();
        // $order->payment_status = "paid";
        // $order->status = "processing";
        // $order->save();
    }
}
