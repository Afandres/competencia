<?php

namespace App\Http\Controllers;
use App\Models\Bicycle; // Importa el modelo
use Illuminate\Http\Request;

class catalogoController extends Controller
{
    public function index()
    {
        $items = Bicycle::all();
        return view('catalogo',compact("items"));
    }
}
