<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

/**
 * Class NotificationController
 * @package App\Http\Controllers
 */
class NotificationController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index($id)
    {
        $user = User::find(Auth::user()->id);
        $notification = $user->notifications()->where('id', $id)->first();
        $notification->update(['read_at' => Carbon::now()]);
        $data = $notification->data;
        if(isset($data['route'])){
            return redirect($data['route']);
        }
        return redirect()->back();
    }

    public function markRead()
    {
        $user = User::find(Auth::user()->id);
        $user->unreadNotifications->markAsRead();
        return response()->json($user->unReadNotifications->count(), 200);
    }
}

