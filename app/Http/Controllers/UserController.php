<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard ()
    {
        $user = Auth::user(); // Obtiene el usuario autenticado

        if ($user->hasRole('admin')) {
            return view('dashboard_admin'); // Vista para administradores
        } elseif ($user->hasRole('apprentice')) {
            return view('dashboard'); // Vista para usuarios regulares
        } else {
            return redirect()->route('home'); // Redirige a la página de inicio o a otra vista por defecto
        }
    }

    public function index ()
    {
        $users = User::get();

        return view('user.index')->with(['users' => $users]);
    }
}
