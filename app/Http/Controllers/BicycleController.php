<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use Illuminate\Http\Request;

class BicycleController extends Controller
{
    public function bicycle_index(){

        $bicycles = Bicycle::all();
        return view('rents.bicycle.index', compact('bicycles'));
    }

    public function bicycle_create(){

        return view('rents.bicycle.create');
    }

    public function bicycle_store(Request $request){

        $request->validate([
            'brand' => 'required|string|min:3',
            'colors' => 'required|string|min:5',
            'state' => 'required|in:Activa,Inactiva',
            'rental_price' => 'required|integer|min:0',

        ]);

        Bicycle::create($request->all());

        return redirect()->route('bicycle.index')->with('success', 'Nueva bicicleta registrada con exito');
    }

    public function bicycle_edit($id){

        $bicycle = Bicycle::findOrFail($id);
        return view('rents.bicycle.edit', compact('bicycle'));
    }
    public function bicycle_update(Request $request, string $id)
    {
        $request->validate([
            'brand' => 'required|string|min:3',
            'colors' => 'required|string|min:5',
            'state' => 'required|in:Activa,Inactiva',
            'rental_price' => 'required|integer|min:0',
        ]);

        // Buscar la bicicleta por ID
        $bicycle = Bicycle::findOrFail($id);

        // Actualizar la bicicleta con los datos del formulario
        $bicycle->update($request->all());

        // Redirigir a la lista de bicicletas con un mensaje de éxito
        return redirect()->route('bicycle.index')->with('success', 'Bicicleta Actualizada con Éxito');
    }
    public function bicycle_destroy($id){

        $bicycle = Bicycle::findOrFail($id);
        $bicycle ->delete();

        return redirect()->route('bicycle.index')->with('danger', 'Bicicleta Eliminada con Exito');
    }

}
