<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Jobs\CancelOrderJob;
use App\Jobs\SendEmailToUserToPayOrder;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use App\Repositories\Cart\CartRepository;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Intl\Locales;
use Illuminate\Support\Str;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutConttoller extends Controller
{

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('front.orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coupon = Session::get('coupon');

        return view('front.checkout', [
            'coupon' => $coupon,
            'discount' => $coupon['discount'] ?? 0,
            'user' => Auth::user(),
            'order' => new Order(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request->all());

        DB::beginTransaction();

        try {

            $order = new Order();

            //createOrder is a method in the Order model

            $chec = $order->createOrder($request);

            DB::commit();

            event(new OrderCreated($chec));

            return redirect()->route('orders', $order->id);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id)
    {
        Order::destroy($id);

        return response()->json(['message' => 'Order deleted!'], 200);
    }


}
