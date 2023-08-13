<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Admin\AboutUsController as AdminAboutUsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ConfigsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CouponsController as AdminCouponsController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PaymentsController as AdminPaymentsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CheckoutConttoller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LangMiddleware;
use App\Models\Product;
use Illuminate\Support\Facades\File;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::middleware(LangMiddleware::class)->group(function () {
    require __DIR__ . '/auth.php';

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['auth']], function () {
        Route::prefix('admin')
            ->middleware(['middleware' => AdminMiddleware::class])
            ->group(function () {
                Route::resource('categories', CategoriesController::class);
                Route::resource('products', ProductsController::class);
                Route::resource('notifications', NotificationsController::class);
                Route::get('/batch/{id}', [NotificationsController::class, 'getBatch']);
                Route::get('contact-us', [ContactUsController::class, 'create'])->name('contact.create');
                Route::post('contact-us', [ContactUsController::class, 'update'])->name('contact.update');
                Route::get('about-us', [AdminAboutUsController::class, 'create'])->name('aboutUs.create');
                Route::post('about-us', [AdminAboutUsController::class, 'update'])->name('aboutUs.update');
                Route::get('settings', [ConfigsController::class, 'create'])->name('settings');
                Route::post('settings', [ConfigsController::class, 'store']);
                Route::get('payments', [AdminPaymentsController::class, 'index'])->name('payments.index');
                Route::get('payment/{id}', [AdminPaymentsController::class, 'show'])->name('payments.show');
                Route::resource('roles', RolesController::class);
                Route::resource('coupons', AdminCouponsController::class);
                Route::resource('orders', OrdersController::class);
                Route::resource('users', UsersController::class);
                Route::get('', [StatisticsController::class, 'index'])->name('statistic.index');
            });
        Route::post('/ratings', [RatingsController::class, 'store'])->name('rating.store');
        Route::post('/coupon/remove', [CouponsController::class, 'removeCoupon'])->name('coupons.remove');
        Route::post('/coupons', [CouponsController::class, 'store'])->name('coupons.apply');
        Route::post('/checkout', [CheckoutConttoller::class, 'store'])->name('checkout.store');

    });

    Route::get('/category/{slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');


    Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');

    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.index');


    Route::get('/orders', [CheckoutConttoller::class, 'index'])->name('orders');
    Route::delete('/orders/{id}', [CheckoutConttoller::class, 'delete'])->name('order.delete');
//    Route::get('orders/{order}/pay', [PaymentsController::class, 'createPayment'])->name('orders.payments.create');
    Route::any('orders/{id}/payment-intent', [PaymentsController::class, 'create'])->name('orders.paymentIntent.create');
    Route::get('orders/payment-intent/callback/{id?}', [PaymentsController::class, 'confirm'])->name('orders.payments.return');
    Route::get('orders/{order}/payment-intent/cancel', [PaymentsController::class, 'cancel'])->name('orders.payments.cancel');
    Route::post('/webhook', [PaymentsController::class, 'webhook'])->name('webhook');


    Route::get('/search', [SearchController::class, 'search'])->name('search');


});

Route::post('/lang', function (\Illuminate\Http\Request $request) {
    $lang = $request->get('lang');
    if ($lang)
        session()->put('lang', $lang);
    return redirect()->back();
})->name('local');




Route::get('storage/{filename}', function ($file) {
    $filePath = storage_path('app/public' . $file);
    if (!is_file($filePath)) {
        abort(404);
    }

    return response()->file($filePath);
})->where('file', '.+');


