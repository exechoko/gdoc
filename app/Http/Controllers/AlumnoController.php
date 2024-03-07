<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Curso;
use App\Models\Escuela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            if ($user->hasRole('Docente') || $user->hasRole('Docente Premium') || $user->hasRole('Docente Pro')) {
                // Obtén los cursos del usuario con relaciones cargadas
                $cursosUsuario = $user->cursos()->get();

                // Obtén los IDs de los cursos del usuario
                $idsCursos = $cursosUsuario->pluck('id');

                // Obtén los alumnos que pertenecen a los cursos del usuario con relaciones cargadas
                $alumnos = Alumno::with('escuela', 'curso')->whereIn('cursos_id', $idsCursos)->get();
            }
        }

        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $escuelas = Escuela::all();
        $cursos = null;
        if ($user->hasRole(['Super Admin', 'Admin'])) {
            $cursos = Curso::all();
        } else {
            $cursos = $user->cursos()->get();
        }
        return view('alumnos.crear', compact('escuelas', 'cursos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'dni' => 'required|unique:alumnos,dni',
                //'email' => 'required|email|unique:alumnos,email',
            ]);

            DB::beginTransaction();
            // Crea el alumno y guarda directamente
            Alumno::create([
                'user_id' => auth()->id(),
                'apellido' => $request->input('apellido'),
                'nombre' => $request->input('nombre'),
                'dni' => $request->input('dni'),
                'fecha_nacimiento' => $request->input('fecha_nacimiento'),
                'email' => $request->input('email'),
                'telefono' => $request->input('telefono'),
                'direccion' => $request->input('direccion'),
                'ciudad' => $request->input('ciudad'),
                'provincia' => $request->input('provincia'),
                'pais' => $request->input('pais'),
                'escuelas_id' => $request->input('escuela_id'),
                'cursos_id' => $request->input('curso_id'),
                'observaciones' => $request->input('observaciones'),
            ]);

            DB::commit();
            return redirect()->route('alumnos.index')->with('success', 'Alumno creado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear el alumno: ' . $e->getMessage());
        }
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
        $user = Auth::user();
        $alumno = Alumno::find($id);
        $escuelas = Escuela::all();
        $cursos = null;
        if ($user->hasRole(['Super Admin', 'Admin'])) {
            $cursos = Curso::all();
        } else {
            $cursos = $user->cursos()->get();
        }
        return view('alumnos.editar', compact('alumno', 'escuelas', 'cursos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'dni' => 'required|unique:alumnos,dni,' . $id,
                'email' => 'required|email|unique:alumnos,email,' . $id,
            ]);

            DB::beginTransaction();

            // Encuentra el alumno a actualizar
            $alumno = Alumno::findOrFail($id);

            // Actualiza los campos
            $alumno->update([
                'user_id' => auth()->id(),
                'apellido' => $request->input('apellido'),
                'nombre' => $request->input('nombre'),
                'dni' => $request->input('dni'),
                'fecha_nacimiento' => $request->input('fecha_nacimiento'),
                'email' => $request->input('email'),
                'telefono' => $request->input('telefono'),
                'direccion' => $request->input('direccion'),
                'ciudad' => $request->input('ciudad'),
                'provincia' => $request->input('provincia'),
                'pais' => $request->input('pais'),
                'escuelas_id' => $request->input('escuela_id'),
                'cursos_id' => $request->input('curso_id'),
                'observaciones' => $request->input('observaciones'),
            ]);

            DB::commit();
            return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar el alumno: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
