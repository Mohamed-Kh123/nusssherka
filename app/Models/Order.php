<?php

namespace App\Models;

use App\Observers\OrderCreated;
use App\Repositories\Cart\CartRepository;
use App\Services\Shipping;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::observe(OrderCreated::class);       
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
                ->using(OrderItem::class)
                ->as('items')
                ->withPivot(['quantity', 'price']);
            
    }
    public function payment()
    {
        return $this->hasMany(Payment::class , 'order_id');
    }

    public function createOrder(CartRepository $cart, Request $request)
    {

        $coupon = Session::get('coupon');
        $newTotal = ($cart->total() - ($coupon['discount'] ?? 0));

        $order = Order::create([
            'billing_name' => $request->billing_name,
            'billing_phone_number' => $request->billing_phone_number,
            'billing_address' => $request->billing_address,
            'billing_email' => $request->billing_email,
            'billing_city' => $request->billing_city,
            'billing_country_name' => $request->billing_country_name,
            'billing_postcode' => $request->billing_postcode,
            'billing_state' => $request->billing_state,
            'shipping_name' => $request->shipping_name,
            'shipping_phone_number' => $request->shipping_phone_number,
            'shipping_address' => $request->shipping_address,
            'shipping_email' => $request->shipping_email,
            'shipping_city' => $request->shipping_city,
            'shipping_country_name' => $request->shipping_country_name,
            'shipping_postcode' => $request->shipping_postcode,
            'shipping_state' => $request->shipping_state,
            'user_id' => Auth::id() ?? null,
            'cookie_id' => $this->getCookieId('orders'),
            'total' => $newTotal,
            'delivery_name' => $request->delivery_name, 
        ]);

        $items = [];
        foreach($cart->all() as $item){
            $items[]= [
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' =>  $item->product->last_price,
            ];
            
        }
        DB::table('order_items')->insert($items);

        return $order;
    }
}
