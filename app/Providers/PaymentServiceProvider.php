<?php

namespace App\Providers;

use App\Repositories\Payment\PaymentMethod;
use App\Repositories\Payment\PaypalPayment;
use App\Repositories\Payment\StripePayment;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentMethod::class, function(){
            if(Config('payment.driver') == 'paypal'){
                return new PaypalPayment();
            }
            if(Config('payment.driver') == 'stripe'){
                return new StripePayment();
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
