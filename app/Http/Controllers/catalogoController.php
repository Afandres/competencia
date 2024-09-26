<?php

namespace App\Http\Controllers;
use App\Models\Bicycle; // Importa el modelo
use Illuminate\Http\Request;

class catalogoController extends Controller
{


    public function bicycle_index(){

        $bicycles = Bicycle::all();
        return view('catalogos.bisis', compact('bicycles'));
    }

    public function rental_index(){

        $bicycles = Bicycle::get();
        return view('rents.bicycle.rental', compact('bicycles'));
    }
}
