<?php

namespace App\Console;

use App\Jobs\CancelOrderJob;
use App\Jobs\DeleteWishListJob;
use App\Jobs\SendEmailToUserToPayOrder;
use App\Jobs\SendNotificationToUserWhoHasWishListJob;
use App\Jobs\VerifiedEmailJob;
use App\Models\Order;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('queue:work', [
        //     '--stop-when-empty' => null,
        // ])->everyMinute();
        // $orders = Order::where('status', 'pending')->get();
        // foreach($orders as $order){
        //     $schedule->job(new SendEmailToUserToPayOrder($order), 'mail')->everyMinute();
        // }
        // $schedule->job(new CancelOrderJob(), 'mail')->everyTwoMinutes();
        // $schedule->job(new DeleteWishListJob())->everyMinute();
        $schedule->job(SendNotificationToUserWhoHasWishListJob::class, 'wishlist')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
