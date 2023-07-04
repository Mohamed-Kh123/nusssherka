<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Carbon;

class OrderCreated
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

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
        
        if(!$order->shipping_name){
            $order->shipping_name = $order->billing_name;
        }
        if(!$order->shipping_country_name){
            $order->shipping_country_name = $order->billing_country_name;
        }
        if(!$order->shipping_company_name){
            $order->shipping_company_name = $order->billing_company_name;
        }
        if(!$order->shipping_address){
            $order->shipping_address = $order->billing_address;
        }
        if(!$order->shipping_apartment_name){
            $order->shipping_apartment_name = $order->billing_apartment_name;
        }
        if(!$order->shipping_city){
            $order->shipping_city = $order->billing_city;
        }
        if(!$order->shipping_state){
            $order->shipping_state = $order->billing_state;
        }
        if(!$order->shipping_postcode){
            $order->shipping_postcode = $order->billing_postcode;
        }
        if(!$order->shipping_email){
            $order->shipping_email = $order->billing_email;
        }
        if(!$order->shipping_phone_number){
            $order->shipping_phone_number = $order->billing_phone_number;
        }
        
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
