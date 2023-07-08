<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Config;
use App\Models\Product;
use App\Models\User;
use App\Models\WishList;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Payment\PaymentMethod;
use App\Repositories\Payment\PaypalPayment;
use App\Repositories\Payment\StripePayment;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // $this->app->bind('path.public', function (){
        //     return base_path('public_html');
        // });

        $this->app->singleton('paypal.client', function($app){
            $config = config('services.paypal');
            if($config['mode'] == 'sandbox'){
                $environment = new SandboxEnvironment($config['client_id'], $config['secret_key']);
            }else{
                $environment = new ProductionEnvironment($config['client_id'], $config['secret_key']);
            }
            $client = new PayPalHttpClient($environment);
            return $client;
        });

        $this->app->bind(PaymentMethod::class, function(){
            if(config('payment.driver') == 'paypal'){
                return new PaypalPayment();
            }
            if(config('payment.driver') == 'stripe'){
                return new StripePayment();
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $prod = $this->app->isProduction();
        Model::preventLazyLoading(!$prod);
        Model::unguard();



//        $settings = Cache::get('app-settings');
//        if(!$settings){
//            $settings = Config::all();
//            Cache::put('app-settings', $settings);
//        }
//
//        foreach($settings as $config){
//            config()->set($config->name, $config->value);
//        }




        Paginator::useBootstrap();

    }

}
