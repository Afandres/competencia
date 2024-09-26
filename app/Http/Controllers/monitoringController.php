<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class monitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_bisicle()
    {
        return view("monitoring.bisicle");
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
