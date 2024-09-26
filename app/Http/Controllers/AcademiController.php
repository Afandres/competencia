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

    public function program_store (Request $request)
    {
        $name = $request->name;
        $code = $request->code;
        $quarter_number = $request->quarter_number;
        $modality = $request->modality;

        $exis_programa = Program::where('code',$code)->first();

        if ($exis_programa) {
            return redirect()->route('program.index')->with('error','El programa ya existe');
        } else {
            $program = new Program;
            $program->name = $name;
            $program->code = $code;
            $program->quarter_number = $quarter_number;
            $program->modality = $modality;
            $program->save();
        }

        return redirect()->route('program.index')->with('success','Programa Registrado');
    }

    public function program_update (Request $request, $id)
    {
        $name = $request->name;
        $code = $request->code;
        $quarter_number = $request->quarter_number;
        $modality = $request->modality;

        $program = Program::findOrfail($id);
        $program->name = $name;
        $program->code = $code;
        $program->quarter_number = $quarter_number;
        $program->modality = $modality;
        $program->save();

        return redirect()->route('program.index')->with('success','Programa Actualizado');
    }

    public function program_destroy ($id)
    {
        $program = Program::findOrfail($id);
        $program->delete();

        return redirect()->route('program.index')->with('success','Programa Eliminado');
    }

    public function course_index ()
    {
        $courses = Course::get();
        $programs = Program::get();

        return view('academi.course.index')->with(['courses' => $courses,'programs' => $programs]);
    }

    public function course_store (Request $request)
    {
        $program_id = $request->program_id;
        $code = $request->code;
        $start_date = $request->start_date;
        $state = $request->state;

        $exis_course = Course::where('code',$code)->first();

        if ($exis_course) {
            return redirect()->route('course.index')->with('error','El Curso ya existe');
        } else {
            $course = new Course;
            $course->program_id = $program_id;
            $course->code = $code;
            $course->start_date = $start_date;
            $course->state = $state;
            $course->save();
        }

        return redirect()->route('course.index')->with('success','Curso Registrado');
    }

    public function course_update (Request $request, $id)
    {
        $program_id = $request->program_id;
        $code = $request->code;
        $start_date = $request->start_date;
        $state = $request->state;

        $course = Course::findOrfail($id);
        $course->program_id = $program_id;
        $course->code = $code;
        $course->start_date = $start_date;
        $course->state = $state;
        $course->save();

        return redirect()->route('course.index')->with('success','Curso Actualizado');
    }

    public function course_destroy ($id)
    {
        $course = Course::findOrfail($id);
        $course->delete();

        return redirect()->route('course.index')->with('success','Curso Eliminado');
    }
}
