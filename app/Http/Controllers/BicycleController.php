<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use App\Models\Rental;
use Carbon\Carbon;
use DB;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('bicycle.index')->with('success', 'Bicicleta Eliminada con Exito');
    }

    public function rental_index(){

        $bicycles = Bicycle::get();
        return view('rents.bicycle.rental', compact('bicycles'));
    }

    public function rental_create($id){
        
        $bicycle = Bicycle::findOrFail($id)->first();
        return view('rents.bicycle.rental_create', compact('bicycle'));
    }

    public function rental_store(Request $request) {

        $start_time = Carbon::parse($request->start_time); // Parseamos a formato de tiempo
        $end_time = Carbon::parse($request->end_time);
        $bicycle_id = $request->bicycle_id;
    
        // Obtener el usuario autenticado
        $user = Auth::user();
        $person_id = $user->person->id;
        $stratum = $user->person->stratum;
    
        $price_per_hour = 4000; // Precio por hora de la bicicleta
    
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
        } elseif ($stratum == 5 || $stratum == 6) {
            $discount = 0; // Sin descuento
        }
        // Calcular la tarifa final con el descuento
        $final_price = $base_price * (1 - $discount);
    
        // Guardar los datos del alquiler
        $rental = new Rental;
        $rental->person_id = $person_id;
        $rental->bicycle_id = $bicycle_id;
        $rental->date = Carbon::now();
        $rental->start_time = $start_time;
        $rental->end_time = $end_time;
        $rental->state = 'Arquilada';
        $rental->price = $final_price;
        $rental->start_latitude = $request->startLatitude;
        $rental->start_longitude = $request->startLongitude;
        $rental->end_latitude = $request->endLatitude;
        $rental->end_longitude = $request->endLongitude;
        $rental->save();

        $bicycle = Bicycle::find($bicycle_id);
        $bicycle->state = 'Inactiva';
        $bicycle->save();
    
        return redirect()->route('rental.index')->with('success', 'Bicicleta Arquilada.  El precio final es: ' . $final_price . ' pesos.');
    }
    
    public function rental_devolution($bicycle_id) {

        $bicycle = Bicycle::findOrFail($bicycle_id);

        // Obtener el último alquiler
        $rental = Rental::where('bicycle_id', $bicycle_id)
                        ->where('state', 'Arquilada') // Filtrar por estado 'Arquilada'
                        ->latest('created_at')        // Obtener el más reciente
                        ->first();                    // Obtener el primer resultado
    
        // Verificar si existe algún alquiler con ese estado
        if (!$rental) {
            return redirect()->back()->with('error', 'No se encontró ningún alquiler activo para esta bicicleta.');
        }
    
        return view('rents.bicycle.rental_devolution', compact('rental','bicycle'));
    }
    
    public function rental_devolution_store(Request $request) {

        $rental_id = $request->rental_id;
        $second_end_time = Carbon::parse($request->end_time); // La hora de devolución real
    
        // Obtener los datos del alquiler original
        $rental = Rental::findOrFail($rental_id);
        $original_end_time = Carbon::parse($rental->end_time); // La hora de fin registrada al inicio
        
        // Obtener el estrato del usuario asociado al alquiler
        $stratum = $rental->person->stratum;
    
        // Calcular el porcentaje de descuento basado en el estrato
        $discount = 0;
        if ($stratum == 1 || $stratum == 2) {
            $discount = 0.10; // 10% de descuento
        } elseif ($stratum == 3 || $stratum == 4) {
            $discount = 0.05; // 5% de descuento
        } elseif ($stratum == 5 || $stratum == 6) {
            $discount = 0.00; // 0% de descuento
        }
    
        // Comparar la hora de devolución con la original
        $additional_price = 0;
        if ($second_end_time->greaterThan($original_end_time)) {
            // Si la hora de devolución es mayor, calcular la diferencia en horas o minutos
            $extra_hours = $original_end_time->diffInHours($second_end_time);
    
            // Calcular tarifa adicional antes del descuento, por ejemplo, $1000 por cada hora extra
            $additional_price = $extra_hours * 1000;
    
            // Aplicar el descuento al cargo adicional
            $additional_price -= ($additional_price * $discount);
        }
    
        // Guardar la hora de devolución y el estado del alquiler
        $rental->second_end_time = $second_end_time; // Guardamos la hora de devolución real
        $rental->state = 'Devuelta';
    
        // Actualizar el precio total (incluyendo la tarifa adicional con descuento)
        $rental->price += $additional_price; // Sumamos la tarifa adicional al precio original
        $rental->save();
    
        // Actualizar el estado de la bicicleta a 'Activa'
        $bicycle_id = $rental->bicycle_id;
        $bicycle = Bicycle::findOrFail($bicycle_id);
        $bicycle->state = 'Activa';
        $bicycle->save();
    
        // Redirigir con mensaje de éxito
        return redirect()->route('rental.index')->with('success', 'Bicicleta devuelta con éxito. Cargo adicional aplicado con descuento si corresponde.  El precio final es: ' . $final_price . ' pesos.');
    }

    public function rental_invoices()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todos los alquileres que ha hecho el usuario
        $rentals = Rental::where('person_id', $user->person->id)
                        ->where('state', 'Devuelta') // Sólo los alquileres devueltos
                        ->get();

        // Retornar la vista con los datos de alquiler
        return view('rents.bicycle.invoices', compact('rentals'));
    }

    public function monthly_earnings(Request $request)
    {
        // Obtener las ganancias mensuales
        $earnings = Rental::selectRaw('MONTH(date) as month, SUM(price) as total')
            ->where('state', 'Devuelta')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('rents.bicycle.earnings', compact('earnings'));
    }

    public function monthly_earnings_pdf(Request $request)
    {
        // Obtener las ganancias mensuales con los alquileres detallados
        $earnings = Rental::selectRaw('MONTH(date) as month, SUM(price) as total')
        ->where('state', 'Devuelta')
        ->with(['bicycle', 'person']) // Asegúrate de que se carguen las relaciones
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Obtener alquileres por mes
        $rentalsByMonth = Rental::where('state', 'Devuelta')
            ->with(['bicycle', 'person']) // Relacionar bicicleta y persona
            ->orderByRaw('MONTH(date)')
            ->get()
            ->groupBy(function($rental) {
                return Carbon::parse($rental->date)->format('F'); // Agrupar por nombre del mes
            });

        // Cargar la vista y pasar los datos
        $pdf = PDF::loadView('rents.bicycle.earnings_pdf', compact('earnings', 'rentalsByMonth'));

        // Descargar el PDF
        return $pdf->download('earnings_report.pdf');
    }

    
}
