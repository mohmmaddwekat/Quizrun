<?php

namespace App\Http\View\Composers;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentNotificationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $student = Auth::guard('student')->user();

        $notification = $student->notifications;
        $unread = $student->unreadNotifications()->count();
        $view->with('notifications', $notification)->with('unread', $unread);
    }
}
