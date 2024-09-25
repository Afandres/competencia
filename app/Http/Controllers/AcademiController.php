<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Course;

class AcademiController extends Controller
{
    public function program_index ()
    {
        $programs = Program::get();

        return view('academi.program.index')->with(['programs' => $programs]);
    }

    public function course_index ()
    {
        $courses = Course::get();

        return view('academi.course.index')->with(['courses' => $courses]);
    }
}
