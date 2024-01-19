<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AlumnoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-alumno|crear-alumno|editar-alumno|borrar-alumno', ['only' => ['index']]);
        $this->middleware('permission:crear-alumno', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-alumno', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-alumno', ['only' => ['destroy']]);
    }
    public function index()
    {
        $user = Auth::user();

        // Verifica si el usuario tiene el rol de "super-admin" o "admin"
        if ($user->hasRole(['Super Admin', 'Admin'])) {
            // Si tiene el rol de "Super Admin" o "Admin", obtén todos los alumnos
            $alumnos = Alumno::with('escuela', 'curso')->get();
            //dd($alumnos);
        } else {
            // Verifica si el usuario tiene el rol de "docente"
            if ($user->hasRole('docente')) {
                $cursosUsuario = $user->cursos;

                // Obtén los IDs de los cursos del usuario
                $idsCursos = $cursosUsuario->pluck('id');

                // Obtén los alumnos que pertenecen a los cursos del usuario con relaciones cargadas
                $alumnos = Alumno::with('escuela', 'curso')->whereIn('curso_id', $idsCursos)->get();
            } /* else {
                // Si el usuario no tiene el rol de "docente", manejar según tus necesidades
                // Puede ser redirigir, mostrar un mensaje, etc.
                // Por ejemplo, podrías obtener todos los alumnos nuevamente
                $alumnos = Alumno::all();
            }*/
        }

        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
