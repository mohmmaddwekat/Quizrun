<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher\Course;
use App\Models\Teacher\Group;
use App\Models\User;
use App\Rules\alpha_num_spaces_symbols;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $courses = Course::all();
        $this->teacherTemplate('course.index', __('Courses'), ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $groups = Group::all();
        $this->teacherTemplate('course.add', __('Add Course'), [
            'groups' => $groups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', new alpha_num_spaces_symbols, 'unique:Courses', 'min:2', 'max:255'],
            'course_duration' => 'required|alpha_num|min:2|max:255',
            'number_of_sections' => 'required|numeric|min:2|max:15',
            'group' => ['required', 'exists:groups,id']
        ]);
        $course = new Course;
        $course->name = $request->post('name');
        $course->course_duration = $request->post('course_duration');
        $course->number_of_sections = $request->post('number_of_sections');
        $course->group_id = $request->post('group');
        $course->teacher_id = Auth::guard('teacher')->user()->id;
        if (!$course->save()) {
            return redirect()->route('teacher.course.index')->with('Error', __('an error occurred'));
        }
        $students = User::all();
        $teacher = Auth::guard('teacher')->user();
        foreach ($students as $student) {
            $student_approval = $student->whereRelation('groups', 'approval', true)->get();
            dd($student_approval);
            $student_approval->NewMessageNotification('New Course','A new educational course has been created by '.$teacher->name.' in the '.$course->group->name.' group. Do you want to read its content?', Teacher::class, $teacher, route('student.group.index', $course->group->id));
        }
        return redirect()->route('teacher.course.index')->with('Success', __('Add success'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $course = Course::find($id);

        if ($course == null) {
            return redirect()->route('teacher.course.index')->with('Error', __('Not Fond') . ' ' . __('course'));
        } else {
            $group_course = $course->group()->pluck('id')->toArray();
            $groups = Group::all();
            $this->teacherTemplate('course.edit', __('Edit Course'), [
                'course' => $course,
                'groups' => $groups,
                'group_course' => $group_course,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => ['required', new alpha_num_spaces_symbols, 'unique:Courses,name,' . $id, 'min:2', 'max:255'],
            'course_duration' => 'required|alpha_num|min:2|max:255',
            'number_of_sections' => 'required|numeric|min:2|max:15',
            'group' => ['required', 'exists:groups,id']
        ]);
        $course = Course::find($id);
        $course->name = $request->post('name');
        $course->course_duration = $request->post('course_duration');
        $course->number_of_sections = $request->post('number_of_sections');
        $course->group_id = $request->post('group');
        $course->teacher_id = Auth::guard('teacher')->user()->id;
        if (!$course->save()) {
            return redirect()->route('teacher.course.index')->with('Error', __('an error occurred'));
        }
        return redirect()->route('teacher.course.index')->with('Success', __('Edit success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $course = Course::find($id);
        if ($course == null) {
            return redirect()->route('teacher.course.index')->with('Error', __('Not Fond') . ' ' . __('course'));
        }
        if ($course->group()->get() ==null) {
            return redirect()->route('teacher.course.index')->with('Error', __('It cannot be deleted because it is related to something else'));
        }
        $course->delete();
        return redirect()->route('teacher.course.index')->with('Success', __('delete success'));
    }
}
