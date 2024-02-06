<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Inicializar la variable para almacenar la cantidad de cursos
        $cantidadCursos = 0;
        $cantidadAlumnos = 0;

        // Verifica si el usuario tiene el rol de "super-admin" o "admin"
        if ($user->hasRole(['Super Admin', 'Admin'])) {
            // Si tiene el rol de "Super Admin" o "Admin", obtén la cantidad de todos los cursos
            $cantidadCursos = Curso::count();
            $cantidadAlumnos = Alumno::count();
        } elseif ($user->hasRole('Docente')) {
            // Verifica si el usuario tiene el rol de "docente"
            // Obtén la cantidad de cursos del usuario
            $cantidadCursos = $user->cursos->count();
            $cantidadAlumnos = $user->alumnos->count();
        }

        return view('dashboard.index', compact('cantidadCursos', 'cantidadAlumnos'));
    }
}
