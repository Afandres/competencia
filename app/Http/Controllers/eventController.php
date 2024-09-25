<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class eventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function event_index()
    {

        $items = Event::all();
        return view('events.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function event_create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function event_store(Request $request)
{

    // Crear un nuevo evento con los datos validados
    Event::create([
        'name' => $request->name,
        'description' => $request->description,
        'date' => $request->date,
        'start_latitude' => $request->startLatitude,
        'start_longitude' => $request->startLongitude,
        'end_latitude' => $request->endLatitude,
        'end_longitude' => $request->endLongitude,
    ]);

    // Redirigir a la vista de índice con un mensaje de éxito
    return redirect()->route('event')->with('success', 'Nuevo evento registrado con éxito');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function event_edit(string $id)
    {

        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function event_update(Request $request, string $id)
    {


        // Buscar el evento por ID
        $event = Event::findOrFail($id);

        // Actualizar el evento con los datos del formulario
        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'start_latitude' => $request->start_latitude,
            'start_longitude' => $request->start_longitude,
            'end_latitude' => $request->end_latitude,
            'end_longitude' => $request->end_longitude,
        ]);

        // Redirigir a la lista de eventos con un mensaje de éxito
        return redirect()->route('event')->with('success', 'Evento actualizado con éxito');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function event_destroy(string $id)
    {

        $bicycle = Event::findOrFail($id);
        $bicycle ->delete();

        return redirect()->route('event')->with('danger', 'evento Eliminada con Exito');
    }
}

