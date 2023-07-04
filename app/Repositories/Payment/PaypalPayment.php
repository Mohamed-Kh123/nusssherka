<?php

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;


class PaypalPayment implements PaymentMethod
{
    protected $client;

    public function __construct()
    {
        $this->client = App::make('paypal.client');
    }
    public function create($id)
    {
        $order = Order::findOrFail($id);
        if($order->payment_status == 'paid'){
            return redirect()->route('orders')->with('success', 'Order already paid!');
        }

        $payment = Payment::where('order_id', '=', $order->id)->where('status', '=', 'CREATED')->first();
        if($payment){
            $links = collect($payment->transaction_data['result']['links']);
            $link = $links->where('rel', '=', 'approve')->first();
            return redirect()->away($link['href']);
        }

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => $order->id,
                "amount" => [
                    "value" => $order->total,
                    "currency_code" => "USD",
                ]
            ]],
            "application_context" => [
                "cancel_url" => url(route('orders.payments.cancel', [$order->id])),
                "return_url" => url(route('orders.payments.return', [$order->id])),
            ]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $this->client->execute($request);

            if ($response && $response->statusCode == 201) {
                $links = collect($response->result->links);
                $link = $links->where('rel', '=', 'approve')->first();
                Payment::create([
                    'order_id' => $order->id,
                    'amount' => $order->total,
                    'currancy' => "USD",
                    'payment_method' => 'paypal',
                    'status' => $response->result->status,
                    'transaction_id' => $response->result->id,
                    'transaction_data' => $response,
                ]);
                return redirect()->away($link->href);
            }

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            // dd($response);
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        if($order->payment_status == 'paid'){
            return redirect()->route('orders')->with('success', 'Order already paid!');
        }

        $paypal_order_id = request('token');
        $payment = Payment::where('transaction_id', '=', $paypal_order_id)->first();
        $payment->status = "APPROVED";

        $payment->save();
        $request = new OrdersCaptureRequest($paypal_order_id);
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $this->client->execute($request);   
            if($response && $response->statusCode == 201 && $response->result->status == "COMPLETED"){
                $order->payment_status = "paid";
                $order->status = "processing";
                $order->save();
                $payment->status = $response->result->status;
                $payment->transaction_data = $response;
                $payment->save();
                return redirect()->route('orders')->with('success', 'Payment completed successfully!');
            }
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }
}
