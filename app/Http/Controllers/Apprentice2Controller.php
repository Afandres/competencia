<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Course;


class Apprentice2Controller extends Controller
{
    // Método para mostrar el formulario de creación
    public function create()
    {
        $people = Person::all(); // Obtén todas las personas para el select
        $courses = Course::all(); // Obtén todos los cursos para el select
        return view('apprentice.create', compact('people', 'courses'));
    }

    // Método para almacenar un nuevo aprendiz
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'person_id' => 'required|exists:people,id',
            'course_id' => 'required|exists:courses,id',
            'state' => 'required|in:EN FORMACIÓN,RETIRADO',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Apprentice::create([
            'person_id' => $request->person_id,
            'course_id' => $request->course_id,
            'state' => $request->state,
        ]);

        return redirect()->route('apprentice.index')->with('success', 'Aprendiz creado exitosamente');
    }

    public function update(Request $request, $id)
    {
        // Validación y lógica de actualización
        $apprentice = Apprentice::findOrFail($id);
        $apprentice->person->update($request->all());

        return redirect()->route('apprentice.course')->with(['success' , 'Aprendiz actualizado exitosamente']);
    }

    public function create(Request $request)
{

    // Validación de los datos
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:50',
        'code' => 'required|string',
        'state' => 'required|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Creación del nuevo aprendiz
    Apprentice::create($request->all());

    return redirect()->route('apprentice.course')->with('success', 'Aprendiz creado exitosamente');
}

    public function destroy($id)
    {
        try {
            $apprentice = Apprentice::findOrFail($id);
            $apprentice->delete(); // También eliminar los datos relacionados si es necesario

         return response()->json(['message' => 'Aprendiz eliminado exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el aprendiz'], 500);
        }
    }
}
