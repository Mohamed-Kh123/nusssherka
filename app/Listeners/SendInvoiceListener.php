<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\OrderCreatedNotifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInvoiceListener
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
     * @param object $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;

        $users = User::where('type', 'super-admin')
            ->orWhere('type', 'admin')
            ->orWhere('id', '=', $order->user_id)
            ->get();

        foreach ($users as $user) {
            $user->notify(new OrderCreatedNotifications($order));
        }
    }
}
