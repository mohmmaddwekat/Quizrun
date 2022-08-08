<?php

namespace App\Http\Controllers\Student;

use App\Models\Admin\Category;
use App\Models\Teacher\Group;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home() {
        $groups = Group::inRandomOrder()->limit(5)->get();
        $categories = Category::all();
        $this->StudentTemplate('home', __('Home'),['groups'=>$groups,'categories'=>$categories]);
    }

}
