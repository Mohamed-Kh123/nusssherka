<?php
namespace App\Repositories\Payment;

use App\Models\Order;
use Illuminate\Http\Request;

interface PaymentMethod
{

    public function create($id);
    public function confirm($id);

}