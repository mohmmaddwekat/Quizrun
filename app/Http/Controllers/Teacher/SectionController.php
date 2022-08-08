<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher;
use App\Models\Teacher\Course;
use App\Models\Teacher\Section;
use App\Models\User;
use App\Rules\alpha_num_spaces;
use App\Rules\alpha_num_spaces_symbols;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sections = Section::all();
        $this->teacherTemplate('section.index', __('Sections'), ['sections' => $sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $courses = Course::all();
        $this->teacherTemplate('section.add', __('Add section'), [
            'courses' => $courses,
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
            'title' => ['required', new alpha_num_spaces_symbols, 'unique:Sections', 'min:2', 'max:255'],
            'description' => ['required', new alpha_num_spaces, 'min:2', 'max:255'],
            'course' =>['required', 'exists:courses,id']
        ]);
        $section = new Section;
        $section->title = $request->post('title');
        $section->course_id = $request->post('course');
        $section->description = $request->post('description');
        if (!$section->save()) {
            return redirect()->route('teacher.section.index')->with('Error', __('an error occurred'));
        }
        $students = User::all();
        $teacher = Auth::guard('teacher')->user();
        foreach ($students as $student) {
            $student_approval = $student->whereRelation('groups', 'approval', true)->get();
            $student_approval->NewMessageNotification('New Section','A new section named '. $section->name. ' has been created for the '.$section->course->name.' course in the '.$section->course->group->name.' group. Do you want to read it?', Teacher::class, $teacher, route('student.course.index', $section->course->id));
        }
        return redirect()->route('teacher.section.index')->with('Success', __('Add success'));
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
        $section = Section::find($id);
        if ($section == null) {
            return redirect()->route('teacher.section.index')->with('Error', __('Not Fond') . ' ' . __('section'));
        } else {
            $course_section = $section->course()->pluck('id')->toArray();
            $courses = Course::all();
            $this->teacherTemplate('section.edit', __('Edit Section'), [
                'section' => $section,
                'courses' => $courses,
                'course_section' => $course_section,
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
            'title' => ['required', new alpha_num_spaces_symbols, 'unique:Sections,title,'.$id, 'min:2', 'max:255'],
            'description' => ['required', new alpha_num_spaces, 'min:2', 'max:255'],
            'course' =>['required', 'exists:courses,id']
        ]);
        $section =  Section::find($id);
        $section->title = $request->post('title');
        $section->course_id = $request->post('course');
        $section->description = $request->post('description');
        if (!$section->save()) {
            return redirect()->route('teacher.section.index')->with('Error', __('an error occurred'));
        }
        return redirect()->route('teacher.section.index')->with('Success', __('Add success'));
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
        $section = Section::find($id);
        if ($section == null) {
            return redirect()->route('teacher.section.index')->with('Error', __('Not Fond') . ' ' . __('section'));
        }
        $section->delete();
        return redirect()->route('teacher.section.index')->with('Success', __('delete success'));
    }
}
