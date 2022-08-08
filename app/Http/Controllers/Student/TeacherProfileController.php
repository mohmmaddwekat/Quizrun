<?php

namespace App\Http\Controllers\Student;

use App\Models\Teacher;

class TeacherProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $teacher = Teacher::find($id);
        if ($teacher == null) {
            return redirect()->route('student.teacher.profile')->with('Error', __('Not Fond') . ' ' . __('Teachers'));
        } else {
            $this->StudentTemplate('profile.teacher', __('Profile'), [
                'teacher' => $teacher,
            ]);
        }
    }
}
