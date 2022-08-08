<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use App\Models\Teacher;
use App\Models\Teacher\Group;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard() {
        $count_student = User::all()->count();
        $count_teacher = Teacher::all()->count();
        $teachers = Teacher::all();
        $count_group = Group::all()->count();
        $count_admin = Admin::all()->count();
        $this->adminTemplate('dashboard', __('Dashboard'),[
            'count_admin'=>$count_admin,
            'count_student'=>$count_student,
            'count_teacher'=>$count_teacher,
            'count_group'=>$count_group,
            'teachers'=>$teachers,
        ]);
    }
}
