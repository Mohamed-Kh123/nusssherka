<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Jobs\SendEmailToUserToPayOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CompleteOrderPaymentProcessListener
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
    public function handle(OrderCreated $event)
    {
        $order = $event->order;
        dispatch(new SendEmailToUserToPayOrder($order))->afterCommit()->delay(now()->addMinute())->onQueue('orders');
    }
}
