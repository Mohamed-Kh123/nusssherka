<?php

namespace App\Models;

use App\Observers\OrderCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_data', 'discount', 'total_before_discount', 'total', 'user_data', 'user_id',
    ];

    protected $casts = [
        'form_data' => 'array',
        'user_data' => 'array',
    ];

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
        return $this->hasMany(Payment::class, 'order_id');
    }

    public function createOrder(Request $request, $data = [])
    {

        $coupon = Session::get('coupon');
        $newTotal = ($request->total - ($coupon ? $coupon['discount'] : 0));

//        $formData = json_encode($array);

        return Order::create([
            'user_id' => Auth::id(),
            'user_data' => Auth::user(),
            'total' => $request->total,
            'total_before_discount' => $newTotal,
            'discount' => $coupon ? $coupon['discount'] : null,
            'form_data' => $data,
        ]);

    }
}
