<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher;
use App\Models\Teacher\Group;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home()
    {

        $id = auth('teacher')->id();
        $teacher = Teacher::find($id);
        $groups = Group::all();
        $count_group = $teacher->groups()->count();
        $groups = $teacher->groups()->get();
        $count_course = 0;
        $number_of_sections = 0;
        $count_section = 0;
        $members = 0;
        $percentage = 0;
        foreach ($groups as $group) {
            $count_course = $count_course + $group->courses()->count();
            $courses = $group->courses()->get();
            $users = $group->users()->get();
            foreach ($courses as $course) {
                $number_of_sections =  $number_of_sections + $course->number_of_sections;
                $count_section = $count_section + $course->section()->count();
            }
            foreach ($users as $user) {
                $members = $members + $user->count();
            }
        }
        if ($number_of_sections != 0) {
            $percentage = round(($count_section / $number_of_sections) * 100, 2);
        }
        $this->teacherTemplate('home', __('Home'), [
            'count_group' => $count_group,
            'count_course' => $count_course,
            'percentage' => $percentage,
            'members' => $members,
            'groups' => $groups,
        ]);
    }
}
