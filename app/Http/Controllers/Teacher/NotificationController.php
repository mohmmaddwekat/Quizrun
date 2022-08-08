<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //                 
        $teacher = Auth::guard('teacher')->user();
        $notifications = $teacher->notifications;
        $unread = $teacher->unreadNotifications()->count();
        $notfy = '';
        foreach ($notifications as $key=>$notification) {
            if ($key<5) {
                $path = '';
            if ($notification->data['sender']['image']) {
                $path = '/assets/uploads/' . $notification->data['sender']['image'];
            } else {
                $path = '/assets/img/avatar-placeholder.png';
            }
            $notfy  = $notfy . '<div></div><a href="' . route('teacher.notification.read', $notification->id) . '" 
             class="dropdown-item"><div class="media">
                <img src="' . $path . '" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                    <h3 class="dropdown-item-title">' . $notification->data['title'] . '</h3>
                    <p class="text-sm text-truncate">' . $notification->data['body'] . '</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ' .
                $notification->created_at->diffForHumans() . '</p>
                </div>
            </div>
        </a>
        <div class="dropdown-divider"></div>';
            }
            
        }
        $notfy = $notfy . '<a href="' . route('teacher.notification.show') . '" class="dropdown-item dropdown-footer">' . __("See All Notifications") . '</a>';
        return [$notfy, $unread];
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function read($id)
    {
        //

        $teacher = Auth::guard('teacher')->user();
        $notification = $teacher->notifications()->find($id);
        $notification->markAsRead();
        if (isset($notification->data['action']) && $notification->data['action']) {
            return redirect()->to($notification->data['action'] . '?notification=' . $notification->id);
        }
        return redirect()->back();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $teacher = Auth::guard('teacher')->user();
        $notifications = $teacher->notifications;
        $this->teacherTemplate('notifications', __('All Notifications'), ['notifications' => $notifications]);
    }
}
