<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Country;
use App\Models\Teacher\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $group_id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$group_id)
    {
        //
        $student = User::find($id);
        if ($student == null) {
            return redirect()->route('teacher.student.profile')->with('Error', __('Not Fond') . ' ' . __('Students'));
        } else {
            $this->teacherTemplate('profile.student', __('Profile'), [
                'student' => $student,
                'group_id' => $group_id,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id 
     * @param  int  $group_id group
     * @return \Illuminate\Http\Response
     */
    public function remove($id,$group_id)
    {
        // 
        $group = Group::find($group_id);
        $user = User::find($id);
        $group->users()->detach($user->id);
        return redirect()->route('teacher.group.member',$group_id);
    }
}
