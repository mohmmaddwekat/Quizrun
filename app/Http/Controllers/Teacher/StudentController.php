<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $group_id
     * @param  int  $notification_id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $group_id)
    {
        //
        $student = User::find($id);
        $group = Group::find($group_id);
        $this->teacherTemplate('student.index', __('join Group'), ['student' => $student, 'group' => $group, 'notification_id' => $request->notification]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  int  $group_id group
     * @return \Illuminate\Http\Response
     */
    public function accept($id, $group_id, $notification_id)
    {
        //
        $group = Group::find($group_id);
        $user = User::find($id);
        DB::table('notifications')->where('id', '=', $notification_id)->delete();
        $group->users()->updateExistingPivot($user->id, ['approval' => true]);
        $teacher = auth('teacher')->user();
        $user->NewMessageNotification('Join request', 'The request to join the ' . $group->name . ' group has been accepted', Teacher::class, $teacher, route('student.group.index', $group->id));
        return redirect()->route('teacher.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id 
     * @param  int  $group_id group
     * @return \Illuminate\Http\Response
     */
    public function reject($id, $group_id, $notification_id)
    {
        // 
        $group = Group::find($group_id);
        $user = User::find($id);
        DB::table('notifications')->where('id', '=', $notification_id)->delete();
        $group->users()->detach($user->id);
        return redirect()->route('teacher.home');
    }
}
