<?php

namespace App\Http\Controllers;

use App\Events\PaymentCreated;
use App\Models\Order;
use App\Models\Payment;
use App\Repositories\Payment\PaymentMethod;
use App\Repositories\Payment\PaypalPayment;
use App\Repositories\Payment\StripePayment;
use Illuminate\Http\Request;


class PaymentsController extends Controller
{
    public function create(Request $request, $id)
    {
        $pay = new PaypalPayment();
        return $pay->create($id);
    }

    public function confirm($id = null)
    {
        if ($id) {
            $pay = new PaypalPayment();
            return $pay->confirm($id);
        }

        $pay = new StripePayment();
        return $pay->confirm();

    }

    public function webhook()
    {
        $pay = new StripePayment();
        return $pay->webhook();
    }
}
