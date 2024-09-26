<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Person;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Apprentice;


class ApprenticeController extends Controller
{

    public function index() {

        $apprentices = Apprentice::get();

        return view('apprentice.index', compact('apprentices'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:50',
            'document_type' => 'required|string',
            'document_number' => 'required|integer',
            'telephone' => 'required|numeric',
            'email' => 'required|email|unique:people',
            'address' => 'required|string',
            'stratum' => 'required|in:1,2,3,4,5,6',
            'course_id' => 'required|exists:courses,id',
            'state' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $person = Person::create([
                'name' => $request->name,
                'document_type' => $request->document_type,
                'document_number' => $request->document_number,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'address' => $request->address,
                'stratum' => $request->stratum,
            ]);

            // Crear el registro del aprendiz
            $apprentice = Apprentice::create([
                'person_id' => $person->id,
                'course_id' => $request->input('course_id'),
            ]);

    } catch (\Exception $e) {
        // Manejar cualquier excepción
        Log::error('Error al registrar a los usuarios: ' . $e->getMessage());
        return back()->with('error', 'Error al registrar a los usuarios');
    }

        // Redirigir a la lista de aprendices con un mensaje de éxito
        return redirect()->route('apprentice.course')->with('success', 'Aprendiz creado exitosamente');
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

        $validator = Validator::make($request->all(), [
            'person_id' => 'required|exists:people,id',
            'course_id' => 'required|exists:courses,id',
            'state' => 'required|in:EN FORMACIÓN,RETIRADO',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Apprentice::create([
            'person_id' => $request->person_id, // Asegúrate de obtener este valor
            'course_id' => $request->course_id,
            'state' => $request->state,
        ]);
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
