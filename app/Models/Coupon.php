<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'code',
        'status',
        'description',
        'limit',
        'discount',
        'expire_date',
    ];

//    public function discount($total)
//    {
//        if($this->type == 'percent'){
//            return ($this->amount / 100) * $total;
//        }
//        if($this->type == 'fixed'){
//            return $this->amount;
//        }
//
//        return 0;
//    }
}
