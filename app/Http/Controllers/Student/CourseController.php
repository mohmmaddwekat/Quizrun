<?php

namespace App\Http\Controllers\Student;

use App\Models\Teacher\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $course = Course::find($id);
        $section = $course->section()->get();
        $this->StudentTemplate('course.index', __('Sections'),['sections'=> $section]);
    }

}
