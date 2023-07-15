<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Carbon;

class OrderCreated
{
    /**
     * Handle the Order "creating" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function creating(Order $order)
    {
        $now = Carbon::now();

        $number = Order::whereYear('created_at', '=', $now->year)->max('number');
        $order->number = $number ? $number + 1 : $now->year . '0001';
    }

}
