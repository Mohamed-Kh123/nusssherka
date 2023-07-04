<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendNotificationsToUsersJob;
use App\Models\User;
use App\Notifications\SendMessageToUserNotifications;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class NotificationsController extends Controller
{
    public function index()
    {
        Gate::authorize('notification.view-any');

        $user = User::where('type', 'super-admin')->first();
        $notifications = $user->notifications()->paginate();
        
        return view('admin.notifications.index', compact('notifications'));
    }

    public function show($id)
    {
        Gate::authorize('notification.view');

        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);

        $notification->markAsRead();

        if (isset($notification->data['url']) && $notification->data['url']) {
            return redirect($notification->data['url']);
        }

        return redirect()->back();
    }

    public function create()
    {
        Gate::authorize('notification.create');

        return view('admin.notifications.create', [
            'users' => User::all(),
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('notification.create');
        if($request->type == "user"){

            $request->validate([
                'title' => 'required',
                'body' => 'required',
                'url' => 'nullable',
                'icon' => 'nullable',
                'action' => 'nullable',
                'user_id' => 'required|exists:users,id',
            ]);
    
            $data = [
                'title' => $request->title,
                'body' => $request->body,
                'icon' => $request->icon,
                'url' => $request->url,
                'action' => $request->action,
                'user_id' => $request->user_id,
            ];
            $admin = User::where('type', 'super-admin')->first();
    
            $notification = $admin->notifications()->create([
                'id' => Str::uuid(),
                'type' => SendMessageToUserNotifications::class,
                'data' => $data,
            ]);
            
            
            $user = User::where('id', $request->user_id)->first();
            Notification::send($user, new SendMessageToUserNotifications($notification));

            return redirect()->back();
        }

        if($request->type == "all_user"){

            
            $request->validate([
                'title' => 'required',
                'body' => 'required',
                'url' => 'nullable',
                'icon' => 'nullable',
                'action' => 'nullable',
            ]);
            $data = [
                'title' => request('title'),
                'body' => request('body'),
                'icon' => request('icon'),
                'url' => request('url'),
                'action' => request('action'),
            ];
            $admin = User::where('type', 'super-admin')->first();
    
            $notification = $admin->notifications()->create([
                'id' => Str::uuid(),
                'type' => SendMessageToAllUserNotifications::class,
                'data' => $data,
            ]);
            $batch = Bus::batch([])->onQueue('notification')->dispatch();

            $users = User::where('type', 'user')->chunk(500, function($users) use ($notification, $batch){
                $batch->add(new SendNotificationsToUsersJob($users, $notification));
            });
            return $batch;
        }

    }

    public function getBatch($id)
    {
        $batchId = request('id');
        $batch = Bus::findBatch($batchId);
        return $batch;
    }

    public function destroy($id)
    {
        Gate::authorize('notification.delete');

        $admin = User::where('type', 'super-admin')->first();

        $notification = $admin->notifications()->findOrFail($id);
        $notification->delete($id);

        return redirect()->back()->with('success', 'Notification deleted!');
        
    }
}
