<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    use HasFactory;
    protected $table = "order_items";
    // protected $timestamps = true;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
