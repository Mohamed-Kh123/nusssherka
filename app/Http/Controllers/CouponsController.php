<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Order;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class CouponsController extends Controller
{

    public function store(Request $request)
    {

        $coupon = Coupon::where('code', '=', $request->code)->first();
        if(!$coupon){
            return response()->json([
                'message' => 'Coupon not found!',
            ]);
        }
        if($coupon->end_date <= now() || $coupon->start_date >= now()){
            return response()->json([
                'message' => 'Coupon expired!',
            ]);
        }



        Session::put('coupon', [
//            'discount' => $coupon->discount($this->cart->total()),
            'name' => $coupon->code,
            'id' => $coupon->id,
        ]);

//        if($request->expectsJson()){
//            $coupon = Session::get('coupon');
//            $newTotal = $this->cart->total() - ($coupon['discount'] ?? 0);
//            $subTotal = $this->cart->subTotal();
//            $quantity = $this->cart->quantity();
//            return [
//                'subTotal' => $subTotal,
//                'newTotal' => $newTotal,
//                'id' => $coupon['id'],
//                'discount' => $coupon['discount'] ?? 0,
//                'quantity' => $quantity,
//                'route' => route('coupons.remove'),
//            ];
//        }

        return redirect()->back()->with('success', __('Coupon has been applied!'));
    }

    public function removeCoupon(Request $request)
    {
        Session::forget('coupon');
        if($request->expectsJson()){
            redirect()->back()->with('success', __('Coupon has been removed!'));
        }
        return  redirect()->back()->with('success', __('Coupon has been removed!'));
    }
}
