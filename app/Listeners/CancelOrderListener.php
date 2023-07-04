<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Jobs\CancelOrderJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CancelOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

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
        dispatch(new CancelOrderJob($order))->afterCommit()->delay(now()->addMinutes(2))->onQueue('orders');
    }
}
