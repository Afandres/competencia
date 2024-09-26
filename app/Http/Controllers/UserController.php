<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Person;
use App\Models\Official;
use Spatie\Permission\Models\Role;
use App\Models\Apprentice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use PasswordValidationRules;
use App\Models\Event;
use Carbon\Carbon;

class UserController extends Controller


{

    public function register_index () {
        return view('auth.register');
    }

    public function search_person(Request $request)
    {
        $document_number = $request->input('document_number');
        $person = Person::where('document_number',$document_number)->first();

        if ($person) {
            $user = User::where('person_id', $person->id)->first();

            if ($user) {
                return response()->json(['error' => 'Esta persona ya cuenta con un usuario']);
            }
            $official = Official::where('person_id',$person->id)->first();
            $apprentice = Apprentice::where('person_id',$person->id)->first();
            if ($official) {
                $rol = 'Funcionario';
            } elseif ($apprentice) {
                $rol = 'Aprendiz';
            } else {
                $rol = 'Ninguno';
            }

            return response()->json(['person' => $person,'rol' => $rol], 200);
        } else {
            return response()->json(['error' => 'Persona no encontrada']);
        }
    }


    public function register_store(Request $request)
    {
        // Obtener los datos del request
        $input = $request->all();
        

        // Validar los datos del formulario
        Validator::make($input, [
            'role_id' => ['required', 'string', 'max:255'],
            'personid' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Contraseña mínima de 8 caracteres y confirmada
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '', // Validar términos y condiciones si aplica
        ])->validate();

        $person_id = $input['personid'];
        $person = Person::findOrfail($person_id);
        $name = $person->name;
        $email = $person->email;

        // Crear el usuario
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'person_id' => $person_id,
            'password' => Hash::make($input['password']),
        ]);

        $role_id = $input['role_id'];
        $role = Role::where('name',$role_id)->first();
        $user->assignRole($role);

        // Puedes retornar una respuesta o redirigir
        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
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

            dd($validator);

            // Crear el registro en la tabla 'people'
            $person = Person::create([
                'name' => $request->name,
                'document_type' => $request->document_type,
                'document_number' => $request->document_number,
                'telephone' => $request->telephone,
                'address' => $request->address,
                'email' => $request->email,
            ]);

            // Crear el registro en la tabla 'users' con la columna 'name_user'
            $user = User::create([
                'name' => $request->name,           // Se puede repetir el nombre si es necesario
                'email' => $request->email,         // Email único tanto en 'users' como en 'people'
                'password' => Hash::make($request->password), // Encriptar la contraseña
                'person_id' => $person->id,         // Relacionar el ID de 'people' con 'users'
            ]);

        Auth::login($user);

    } catch (\Exception $e) {
        // Loguear el error y mostrar un mensaje de error
        Log::error('Error al registrar a los usuarios: ' . $e->getMessage());
        return back()->with('error', 'Error al registrar a los usuarios');
    }

    // Redirigir al dashboard o al perfil del usuario
    return redirect()->route('dashboard')->with('success', 'Registro exitoso.');
    }

    public function dashboard()
    {
        $user = Auth::user(); // Obtiene el usuario autenticado
    
        // Verifica si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login'); // Redirige a la página de inicio de sesión
        }
    
        // Verifica los roles del usuario
        if ($user->hasRole('admin')) {
            return view('dashboard.dashboard_admin'); // Vista para administradores
        } elseif ($user->hasRole('aprendiz')) {
            $events = Event::where('date', '>', Carbon::now())->get();
            return view('dashboard.dashboard_apprentice', compact('events')); // Vista para usuarios regulares
        } elseif ($user->hasRole('funcionario')) {
            $events = Event::where('date', '>', Carbon::now())->get();
            return view('dashboard.dashboard_official', compact('events')); // Vista para usuarios regulares
        } else {
            return redirect()->route('login'); // Redirige si el usuario no tiene un rol válido
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
