<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Statistic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class AddOrderToStatistics
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

        $total_orders = new Statistic();
        $value = $total_orders->getValue('total_orders');
        if($value){
            $total_orders->setValue('total_orders', DB::raw('value + 1'));
        }
        if(!$value){
            $total_orders->setValue('total_orders', 1);
        }
    }
}
