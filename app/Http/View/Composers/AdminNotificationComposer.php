<?php

namespace App\Http\View\Composers;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminNotificationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $admin = Auth::guard('admin')->user();

        $notification = $admin->notifications;
        $unread = $admin->unreadNotifications()->count();
        $view->with('notifications', $notification)->with('unread', $unread);
    }
}
