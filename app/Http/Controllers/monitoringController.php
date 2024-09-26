<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Rental;


class monitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_bisicle()
    {
        // Obtener las bicicletas alquiladas
        $rentals = Rental::with('bicycle','person')->where('state', 'Arquilada')->get();
        return view("monitoring.bisicle")->with(['rentals' => $rentals]);
    }

    public function index_event()
    {
        $items = Event::all();
        return view("monitoring.event",compact("items"));
    }

    public function show(string $id)
    {
        //
    }
}
