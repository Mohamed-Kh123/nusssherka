<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Events\PaymentCreated;
use App\Listeners\AddOrderToStatistics;
use App\Listeners\CancelOrderListener;
use App\Listeners\ChangeOrderPaymentStatusListnere;
use App\Listeners\CompleteOrderPaymentProcessListener;
use App\Listeners\DeleteCartListener;
use App\Listeners\DeleteCouponListener;
use App\Listeners\SendInvoiceListener;
use App\Listeners\SendPaymentNotificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        OrderCreated::class => [
            SendInvoiceListener::class,
            DeleteCartListener::class,
            DeleteCouponListener::class,
            CompleteOrderPaymentProcessListener::class,
            CancelOrderListener::class,
            AddOrderToStatistics::class,
        ],

        PaymentCreated::class => [
            SendPaymentNotificationListener::class,
            ChangeOrderPaymentStatusListnere::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
