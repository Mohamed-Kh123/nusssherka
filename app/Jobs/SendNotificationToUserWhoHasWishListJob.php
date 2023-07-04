<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\WishList;
use App\Notifications\WishListNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class SendNotificationToUserWhoHasWishListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $wishLists = WishList::whereNotNull('user_id')->get();
        foreach($wishLists as $wishList){
            $users = User::where('id', $wishList['user_id'])->get();
            Notification::send($users, new WishListNotification());
        }
    }
}
