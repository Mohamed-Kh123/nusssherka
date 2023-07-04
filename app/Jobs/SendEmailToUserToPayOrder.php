<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\User;
use App\Notifications\CompleteOrderPaymentProcess;
use App\Notifications\SendEmailToUserToPayOrder as NotificationsSendEmailToUserToPayOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendEmailToUserToPayOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected $order)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = Order::find($this->order->id);
        if($order && $order->status == "pending"){
            Notification::route('mail', $order->billing_email)->notify(new CompleteOrderPaymentProcess());
        }
    }
}
