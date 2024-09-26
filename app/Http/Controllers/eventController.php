<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Participation;
use App\Models\Rental;
use App\Models\Bicycle;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

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
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'start_latitude' => null,
        'start_longitude' => null,
        'end_latitude' => null,
        'end_longitude' => null,
    ]);

    // Redirigir a la vista de índice con un mensaje de éxito
    return redirect()->route('event')->with('success', 'Nuevo evento registrado con éxito');
}


public function ubicacion($id)
{
    return view("events.addUbicacion",compact("id"));
}

public function event_store_ubicacion(Request $request)
{
    // Buscar el evento por ID
    $event = Event::findOrFail($request->id);

    // Actualizar el evento con los datos del formulario
    $event->update([
        'start_latitude' => $request->startLatitude,
        'start_longitude' => $request->startLongitude,
        'end_latitude' => $request->endLatitude,
        'end_longitude' => $request->endLongitude,
    ]);

    // Redirigir a la lista de eventos con un mensaje de éxito
    return redirect()->route('event')->with('success', 'Evento actualizado con éxito');
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

    public function showUpdateImageForm($id)
{
    $event = Event::findOrFail($id); // Asegúrate de que el evento existe
    return view('events.imgForm', compact('event'));
}
public function updateImage(Request $request, $id)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $event = Event::findOrFail($id); // Asegúrate de que el evento existe

    if ($request->hasFile('image')) {
        // Almacena la imagen en 'public/images' y obtiene la ruta
        $imagePath = $request->file('image')->store('images', 'public');

        // Actualiza la ruta de la imagen en la base de datos
        $event->image = $imagePath; // Asegúrate de que esta es la columna correcta en tu tabla
        $event->save();
    }

    return redirect()->route('event')->with('success', 'Imagen actualizada con éxito');
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

    public function event_participate($id) {
    // Obtener el usuario autenticado
    $user = Auth::user();
    $person_id = $user->person->id;
    $stratum = $user->person->stratum;

    // Verificar si el usuario ya está inscrito en el evento
    $eventparticipation = Participation::where('person_id', $person_id)
                                       ->where('event_id', $id)
                                       ->first();

    if ($eventparticipation) {
        return redirect()->route('dashboard')->with('error', 'Ya estás inscrito');
    } else {
        // Obtener el evento
        $event = Event::findOrFail($id);

        // Obtener la primera bicicleta activa
        $bicycle = Bicycle::where('state', '=', 'Activa')->first();
        if (!$bicycle) {
            return redirect()->route('dashboard')->with('error', 'No hay bicicletas disponibles');
        }

        $price_per_hour = 4000; // Precio por hora de la bicicleta
        
        // Convertir las horas de inicio y fin a objetos Carbon
        $start_time = \Carbon\Carbon::parse($event->start_time);
        $end_time = \Carbon\Carbon::parse($event->end_time);
        
        // Calcular la diferencia de horas
        $hours = $start_time->diffInHours($end_time);
    
        // Calcular tarifa base
        $base_price = $price_per_hour * $hours;
    
        // Aplicar descuento según estrato
        $discount = 0;
        if ($stratum == 1 || $stratum == 2) {
            $discount = 0.10; // 10% de descuento
        } elseif ($stratum == 3 || $stratum == 4) {
            $discount = 0.05; // 5% de descuento
        }

        // Calcular la tarifa final con el descuento
        $final_price = $base_price * (1 - $discount);
    
        // Guardar los datos del alquiler
        $rental = new Rental;
        $rental->person_id = $person_id;
        $rental->bicycle_id = $bicycle->id;
        $rental->date = $event->date;
        $rental->state = 'Arquilada';
        $rental->price = $final_price;
        $rental->start_latitude = $event->start_latitude;
        $rental->start_longitude = $event->start_longitude;
        $rental->end_latitude = $event->end_latitude;
        $rental->end_longitude = $event->end_longitude;
        $rental->save();

        // Guardar la participación
        $participation = new Participation;
        $participation->person_id = $person_id;
        $participation->event_id = $id;
        $participation->rental_id = $rental->id;
        $participation->save();

        // Actualizar el estado de la bicicleta a 'Inactiva'
        $bicycle->state = 'Inactiva';
        $bicycle->save();

        // Devolver el precio final en la respuesta
        return redirect()->route('dashboard')->with('success', 'Participación enviada. El precio final es: ' . $final_price . ' pesos.');

    }
}

    
}