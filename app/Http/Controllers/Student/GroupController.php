<?php

namespace App\Http\Controllers\Student;

use App\Models\Admin\Category;
use App\Models\Teacher;
use App\Models\Teacher\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id group
     * 
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $user = auth('student')->user();
        
        $approval = $user->whereRelation('groups', 'approval', false)->get();
        $group = Group::find($id);
        $users = $group->users()->pluck('id')->toArray();
            if (in_array(auth('student')->id(), $users)) {
                $courses = $group->courses()->get();
                $forum = $group->forum()->first();
                $this->StudentTemplate('group.index',__('Courses'),['courses'=>$courses,'forum'=>$forum]);
            }
        
    }
    /**
     * Send Message Notification 
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function join($id)
    {
        //
        $group = Group::find($id);
        $teacher = Teacher::find($group->teacher_id);
        $student = Auth::guard('student')->user();
        $teacher->NewMessageNotification('Join the Group', $student->name . ' asked to join the group called ' . $group->name, User::class, $student, route('teacher.student.show', [$student->id,$group->id]));
        $group->users()->sync($student->id);
        return $group->id;
    }
    /**
     * Send Message Notification 
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        //
        $category = Category::find($id);
        $groups = $category->groups()->get();
        $this->StudentTemplate('group.category',__('Sort by category'),['groups'=>$groups]);
    }

    /**
     * Send Message Notification 
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $group = Group::find($id);
        $this->StudentTemplate('group.show',__('Show'),['group'=>$group]);
    }
    /**
     * member of Group 
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function member($id)
    {
        //
        $group = Group::find($id);
        return $this->StudentTemplate('group.member',__('Members'),['teachers'=>$group->teacher()->get(),'students'=>$group->users()->paginate(5)]);
    }
    /**
     * My Group 
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function myGroup($id)
    {
        //
        $user = User::find($id);
        return $this->StudentTemplate('group.myGroup',__('My Groups'),['groups'=>$user->groups()->get()]);
    }
}
