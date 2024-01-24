<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asistencia;
use App\Models\Curso;
use App\Models\Escuela;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-curso|crear-curso|editar-curso|borrar-curso', ['only' => ['index']]);
        $this->middleware('permission:crear-curso', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-curso', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-curso', ['only' => ['destroy']]);
    }
    public function index()
    {
        $user = Auth::user();

        // Verifica si el usuario tiene el rol de "super-admin" o "admin"
        if ($user->hasRole(['Super Admin', 'Admin'])) {
            // Si tiene el rol de "Super Admin" o "Admin", obtén todos los alumnos
            $cursos = Curso::with('escuela')->get();
        } else {
            // Verifica si el usuario tiene el rol de "docente"
            if ($user->hasRole('Docente')) {
                // Obtén los cursos del usuario con relaciones cargadas
                $cursos = $user->cursos()->with('escuela')->get();
            }
        }

        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $escuelas = Escuela::all();
        return view('cursos.crear', compact('escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'escuela_id' => 'required',
                'nivel' => 'required',
            ]);

            DB::beginTransaction();
            // Crea el curso y guarda directamente
            Curso::create([
                'users_id' => auth()->id(),
                'escuelas_id' => $request->input('escuela_id'),
                'nivel' => $request->input('nivel'),
                'division' => $request->input('division'),
                'observaciones' => $request->input('observaciones'),
            ]);

            DB::commit();
            return redirect()->route('cursos.index')->with('success', 'Curso creado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear el curso: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = Curso::find($id);
        $alumnos = $curso->alumnos()->get();
        return view('cursos.ver', compact('alumnos', 'curso'));
    }

    // En tu controlador
    public function obtenerNotas($alumnoId)
    {
        //dd($alumnoId);
        $alumno = Alumno::findOrFail($alumnoId);
        $notas = $alumno->calificaciones;
        // Formatea las fechas utilizando Carbon
        foreach ($notas as $nota) {
            $nota->creado = Carbon::parse($nota->created_at)->format('d/m/Y');
            $nota->actualizado = Carbon::parse($nota->updated_at)->format('d/m/Y');
            $nota->materia = $nota->asignatura->nombre;
        }

        $notasData = [
            'notas' => $notas,
        ];

        return response()->json($notasData);
    }

    public function obtenerAsistencias($alumnoId)
    {
        Carbon::setLocale('es');
        //dd($alumnoId);
        $alumno = Alumno::findOrFail($alumnoId);
        $asistencias = $alumno->asistencias;
        // Formatea las fechas utilizando Carbon
        foreach ($asistencias as $asistencia) {
            $asistencia->creado = Carbon::parse($asistencia->created_at)->format('d/m/Y');
            //$asistencia->creado = Carbon::parse($asistencia->created_at)->format('l, j F Y');
            $asistencia->actualizado = Carbon::parse($asistencia->updated_at)->format('d/m/Y');
            $asistencia->asistio = $asistencia->fecha_asistencia ? 'SI' : 'NO';
        }
        $asistenciasData = [
            'asistencias' => $asistencias,
        ];
        return response()->json($asistenciasData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $curso = Curso::find($id);
        $escuelas = Escuela::all();
        $cursos = null;
        if ($user->hasRole(['Super Admin', 'Admin'])) {
            $cursos = Curso::all();
        } else {
            $cursos = $user->cursos()->get();
        }
        return view('cursos.editar', compact('curso', 'escuelas', 'cursos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'escuela_id' => 'required',
                'nivel' => 'required',
            ]);

            DB::beginTransaction();
            // Encuentra el alumno a actualizar
            $curso = Curso::findOrFail($id);
            $curso->update([
                'users_id' => auth()->id(),
                'escuelas_id' => $request->input('escuela_id'),
                'nivel' => $request->input('nivel'),
                'division' => $request->input('division'),
                'observaciones' => $request->input('observaciones'),
            ]);

            DB::commit();
            return redirect()->route('cursos.index')->with('success', 'Curso actualizado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar el curso: ' . $e->getMessage());
        }
    }

    public function nuevaAsistencia(string $id)
    {
        $curso = Curso::find($id);
        $alumnos = $curso->alumnos()->get();
        return view('cursos.nueva_asistencia', compact('alumnos', 'curso'));
    }

    public function guardarAsistencia(Request $request, string $cursoId)
    {
        try {
            $request->validate([
                'fecha_asistencia' => 'required|date',
                'presentes' => 'required|array',
            ]);
            DB::beginTransaction();
            $curso = Curso::find($cursoId);
            $alumnos = $curso->alumnos;
            foreach ($alumnos as $alumno) {
                Asistencia::create([
                    'cursos_id' => $curso->id,
                    'alumnos_id' => $alumno->id,
                    'fecha_asistencia' => $request->input('presentes.' . $alumno->id) === 'on' ? $request->input('fecha_asistencia') : null,
                    'observaciones' => $request->input('observaciones'),
                ]);
            }
            DB::commit();
            return view('cursos.ver', compact('alumnos', 'curso'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar las asistencias: ' . $e->getMessage());
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
