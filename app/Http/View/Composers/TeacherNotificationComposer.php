<?php

namespace App\Http\View\Composers;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TeacherNotificationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $teacher = Auth::guard('teacher')->user();

        $notification = $teacher->notifications;
        $unread = $teacher->unreadNotifications()->count();
        $view->with('notifications', $notification)->with('unread', $unread);
    }
}
