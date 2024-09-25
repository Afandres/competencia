<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view("monitoring.event");
    }

    public function show(string $id)
    {
        //
    }
}
