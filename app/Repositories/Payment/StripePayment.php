<?php
namespace App\Repositories\Payment;

use App\Events\PaymentCreated;
use App\Models\Order;
use App\Models\Payment;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripePayment implements PaymentMethod
{
  public function create($id)
  { 
    \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));
    header('Content-Type: application/json');
    $tran = Str::random(6) . '-' . rand(1, 1000);
    session()->put('transaction_ref', $tran);
    
    $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));

    $order = Order::findOrFail($id);
    if($order->cookie_id != Cookie::get('orders') || $order->user_id != Auth::id()){
      abort(403);
    }
    $line_items = [];
    foreach($order->products as $item){
      $line_items[] = [
        'price_data' => [
          'currency' => 'usd',
          'product_data' => [
            'name' => $item->name,
          ],
          'unit_amount' => $item->items->price * 100,
        ],
        'quantity' => $item->items->quantity,
      ];
    }


    $checkout_session = \Stripe\Checkout\Session::create([
      'payment_method_types' => ['card'],
      'line_items' => [$line_items],
      'mode' => 'payment',
      'success_url' => route('orders.payments.return', [], true)."?session_id={CHECKOUT_SESSION_ID}",
      'cancel_url' => route('home', [], true),
    ]);

    $order->session_id = $checkout_session->id;
    $order->save();

    // return $checkout_session;

    return redirect($checkout_session->url);  
  }

  public function confirm($id = null)
  {
    \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));
    try{

      $sessionId = request()->get('session_id');
      $session = \Stripe\Checkout\Session::retrieve($sessionId);
  
      if(!$session){
        throw new NotFoundHttpException();
      }

      $order = Order::where('session_id', $session->id)->first();

      if(!$order){
        throw new NotFoundHttpException();
      }

      if($order->payment_status == "unpaid"){
        
        $order->status = 'processing';
        $order->payment_status = 'paid';
        $order->save();

        $payment = Payment::create([
          'order_id' => $order->id,
          'amount' => $order->total,
          'currancy' => 'USD',
          'payment_method' => 'stripe',
          'status' => 'completed',
          'transaction_id' => $sessionId,
          'transaction_data' => $session,
        ]);

        event(new PaymentCreated($payment));
      }


      return redirect()->route('orders')->with('success', __('The order has been successfully paid'));
    }catch(\Exception $e){
      throw new NotFoundHttpException();
    }
  }

  public function webhook()
  {
    $endpoint_secret = config('services.stripe.webhook_key');

    $payload = @file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    $event = null;

    try {
      $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
      );
    } catch(\UnexpectedValueException $e) {
      // Invalid payload
      return response('', 400);
    } catch(\Stripe\Exception\SignatureVerificationException $e) {
      // Invalid signature
      return response('', 400);
    }

    // Handle the event
    switch ($event->type) {
      case 'checkout.session.completed':
        $session = $event->data->object;
        $order = Order::where('session_id', $session->id)->first();
        if($order && $order->payment_status == "unpaid"){
          $order->payment_status = 'paid';
          $order->status = "processing";
          $order->save();

          $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'currancy' => 'USD',
            'payment_method' => 'stripe',
            'status' => 'completed',
            'transaction_id' => $session->id,
            'transaction_data' => $session,
          ]);

          event(new PaymentCreated($payment));

        }

      case 'refund.created':
        $refund = $event->data->object;
      case 'refund.updated':
        $refund = $event->data->object;
      // ... handle other event types

      default:
        echo 'Received unknown event type ' . $event->type;
    }

    return response('');

  }

}