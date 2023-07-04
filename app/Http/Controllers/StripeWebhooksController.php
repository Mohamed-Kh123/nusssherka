<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeWebhooksController extends Controller
{
    public function handel()
    {
        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        }

        // Handle the event
        $paymentIntent = $event->data->object; 
        $payment = Payment::where('transaction_id', $paymentIntent->id)->first();
        $order = Order::where('id', $payment->order_id)->first();
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $order->payment_status = "paid";
                $order->status = "processing";
                $order->save();
                Log::debug('payment sssusus', [$order]);
                break;
            case 'payment_intent.canceled':
                $payment->status = "cancelled";
                $payment->save();
                $order->payment_status = "cancelled";
                $order->status = "pending";
                $order->save();
                break;
            case 'payment_intent.payment_failed':
                $payment->status = "failed";
                $payment->save();
                $order->payment_status = "failed";
                $order->status = "pending";
                $order->save();
                default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }
}
