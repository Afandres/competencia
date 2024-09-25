<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function store(Request $request)
    {
        dd($request->all());

        $validator = validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email|unique:people,email',
            'document_type' => 'required|string|max:255',
            'document_number' => 'required|numeric',
            'telephone' => 'required|string|min:10',
            'address' => 'required|string|max:50',
            'name_user' => 'required|string|max:50',
            'password' => 'required|string|min:10|confirmed',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        try {

            // Iniciar transacción
            DB::beginTransaction();

            // Crear el registro en la tabla 'people'
            $person = Person::create([
                'name' => $request->name,
                'document_type' => $request->document_type,
                'document_number' => $request->document_number,
                'telephone' => $request->telephone,
                'address' => $request->address,
                'email' => $request->email,
            ]);



            $user = User::create([
                'name_user' => $request->name_user,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'person_id' => $person->id, // Asegúrate de que $person se ha creado correctamente
            ]);

            // Si todo es exitoso, hacer commit
            DB::commit();

            Auth::login($user); // Iniciar sesión automáticamente

        } catch (\Exception $e) {
            // Si ocurre un error, revertir la transacción
            DB::rollBack();
            Log::error('Error al registrar a los usuarios: ' . $e->getMessage());
            return back()->with('error', 'Error al registrar a los usuarios');
        }

        // Redirigir al dashboard o al perfil del usuario
        return redirect()->route('dashboard')->with('success', 'Registro exitoso.');
    }

    public function dashboard ()
    {
        $user = Auth::user(); // Obtiene el usuario autenticado

        if ($user->hasRole('admin')) {
            return view('dashboard.dashboard_admin'); // Vista para administradores
        } elseif ($user->hasRole('apprentice')) {
            return view('dashboard'); // Vista para usuarios regulares
        } else {
            return redirect()->route('login'); // Redirige a la página de inicio o a otra vista por defecto
        }
    }

    public function index ()
    {
        $users = User::get();

        return view('user.index')->with(['users' => $users]);
    }

    public function destroy (Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }



}
