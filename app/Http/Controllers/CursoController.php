<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asignatura;
use App\Models\Asistencia;
use App\Models\Calificacion;
use App\Models\Curso;
use App\Models\Escuela;
use App\Models\Evaluacion;
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
            if ($user->hasRole('Docente') || $user->hasRole('Docente Premium') || $user->hasRole('Docente Pro')) {
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
        $asignaturas = Asignatura::all();
        return view('cursos.crear', compact('asignaturas', 'escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Primero, verificamos si el usuario tiene permiso para crear otro curso
        $canCreate = $this->authorize('create', Curso::class);
        //dd('aca');
        if (!$canCreate) {
            return redirect()->back()->with('error', 'No tienes permiso para crear otro curso.');
        }

        //dd($request->all());
        try {
            $request->validate([
                'escuela_id' => 'required',
                'asignatura_id' => 'required',
                'nivel' => 'required',
            ]);

            DB::beginTransaction();
            // Crea el curso y guarda directamente
            Curso::create([
                'user_id' => auth()->id(),
                'escuelas_id' => $request->input('escuela_id'),
                'asignatura_id' => $request->input('asignatura_id'),
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
        $asignaturas = Asignatura::all();
        $fechasAsistencia = Asistencia::where('cursos_id', $curso)->pluck('fecha_asistencia')->unique();
        return view('cursos.ver', compact('asignaturas', 'alumnos', 'curso', 'fechasAsistencia'));
    }

    // En tu controlador
    public function obtenerNotas($alumnoId)
    {
        //dd($alumnoId);
        $alumno = Alumno::findOrFail($alumnoId);
        $notas = $alumno->calificaciones;
        // Formatea las fechas utilizando Carbon
        foreach ($notas as $nota) {
            $nota->fecha = Carbon::parse($nota->evaluacion->fecha_evaluacion)->format('d/m/Y');
            //$nota->actualizado = Carbon::parse($nota->updated_at)->format('d/m/Y');
            $nota->materia = $nota->asignatura->nombre;
            $nota->observaciones = $nota->evaluacion->observaciones;
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
            $asistencia->fecha = Carbon::parse($asistencia->fecha_asistencia)->format('d/m/Y H:d');
            $asistencia->actualizado = Carbon::parse($asistencia->updated_at)->format('d/m/Y');
            $asistencia->asistio = $asistencia->asistio ? 'SI' : 'NO';
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
                'user_id' => auth()->id(),
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
                $alumnoId = $alumno->id;
                // Verificar si el alumno está presente
                $estaPresente = isset($request->presentes[$alumnoId]) && $request->presentes[$alumnoId] === "on";
                $fechaAsistencia = $request->fecha_asistencia;
                // Verificar si ya existe una asistencia para este alumno, curso y fecha
                $asistenciaExistente = Asistencia::where('cursos_id', $curso->id)
                    ->where('alumnos_id', $alumnoId)
                    ->where('fecha_asistencia', $fechaAsistencia)
                    ->first();
                if ($asistenciaExistente) {
                    // Actualizar la asistencia existente
                    $asistenciaExistente->update([
                        'asistio' => $estaPresente,
                        'observaciones' => $request->input('observaciones'),
                    ]);
                } else {
                    // Crear una nueva asistencia
                    Asistencia::create([
                        'cursos_id' => $curso->id,
                        'alumnos_id' => $alumnoId,
                        'fecha_asistencia' => $fechaAsistencia,
                        'asistio' => $estaPresente,
                        'observaciones' => $request->input('observaciones'),
                    ]);
                }
            }
            DB::commit();
            $asignaturas = Asignatura::all();
            return view('cursos.ver', compact('asignaturas', 'alumnos', 'curso'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar las asistencias: ' . $e->getMessage());
        }
    }


    public function nuevaEvaluacion(Request $request, $cursoId)
    {
        //dd($request->all());
        //dd($cursoId);
        try {
            $request->validate([
                'asignatura' => 'required',
                'fecha_evaluacion' => 'required|date',
            ]);
            DB::beginTransaction();
            $curso = Curso::find($cursoId);
            Evaluacion::create([
                'cursos_id' => $curso->id,
                'asignatura_id' => $request->asignatura,
                'fecha_evaluacion' => $request->fecha_evaluacion,
                'observaciones' => $request->input('observaciones'),
            ]);
            DB::commit();
            return response()->json(['message' => 'Evaluacion creada exitosamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al crear la evaluacion: ' . $e->getMessage()], 500);
        }
    }

    public function nuevaCalificacion(string $id)
    {
        $curso = Curso::find($id);
        $asignaturas = Asignatura::all();
        $alumnos = $curso->alumnos()->get();
        $evaluaciones = $curso->evaluaciones()->get();
        ;
        return view('cursos.calificar', compact('evaluaciones', 'asignaturas', 'alumnos', 'curso'));
    }

    public function obtenerCalificaciones($evaluacionId)
    {
        // Obtén las calificaciones para la evaluación seleccionada
        $calificaciones = Calificacion::where('evaluacion_id', $evaluacionId)->with('alumno')->get();
        return response()->json($calificaciones);
    }

    public function calificar(Request $request, string $cursoId)
    {
        //dd($request->all());
        try {
            $request->validate([
                'asignatura_id' => 'required',
                'evaluacion_id' => 'required',
                'notas' => 'required|array',
                'observaciones' => 'required|array',
            ]);
            DB::beginTransaction();
            $curso = Curso::find($cursoId);
            $evaluacion = Evaluacion::find($request->evaluacion_id);
            $asignatura = Asignatura::find($request->asignatura_id);
            $alumnos = $curso->alumnos;

            //dd($alumnos);
            foreach ($alumnos as $alumno) {
                //Obtener la nota específica para cada alumno
                $nota = $request->input('notas.' . $alumno->id);
                $observacion = $request->input('observaciones.' . $alumno->id);
                Calificacion::updateOrCreate(
                    [
                        'evaluacion_id' => $evaluacion->id,
                        'asignatura_id' => $asignatura->id,
                        'cursos_id' => $curso->id,
                        'alumnos_id' => $alumno->id,
                    ],
                    [
                        'nota' => $nota,
                        'observaciones' => $observacion,
                    ]
                );
            }
            DB::commit();

            $asignaturas = Asignatura::all();
            return view('cursos.ver', compact('asignaturas', 'alumnos', 'curso'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar las calificaciones: ' . $e->getMessage());
        }
    }

    public function mostrarAsistencias($cursoId)
    {
        $curso = Curso::find($cursoId);
        $alumnos = $curso->alumnos;
        $asignaturas = Asignatura::all();

        // Obtener fechas de asistencia, excluyendo aquellas con valor null
        $fechasAsistencia = Asistencia::where('cursos_id', $cursoId)
            ->whereNotNull('fecha_asistencia')
            ->pluck('fecha_asistencia')
            ->unique();

        // Fecha con formato dd/mm/yyyy para títulos de las columnas
        $fechasCabeceras = Asistencia::where('cursos_id', $cursoId)
            ->whereNotNull('fecha_asistencia')
            ->pluck('fecha_asistencia')
            ->unique()
            ->map(function ($fecha) {
                // Formatear la fecha como "dd/mm/yyyy HH:mm"
                return Carbon::parse($fecha)->format('d/m/Y H:i');
            });

        // Crear un array para almacenar el estado de asistencia por alumno y fecha
        $asistenciasData = [];

        foreach ($alumnos as $alumno) {
            $asistenciaAlumno = [];

            foreach ($fechasAsistencia as $fecha) {
                // Verificar si existe una asistencia para esta fecha y este alumno
                $asistencia = Asistencia::where('cursos_id', $cursoId)
                    ->where('alumnos_id', $alumno->id)
                    ->where('fecha_asistencia', $fecha)
                    ->first();

                // Obtener el estado de asistencia
                $estadoAsistencia = $asistencia ? ($asistencia->asistio ? 'Presente' : 'Ausente') : 'Sin registro';

                $asistenciaAlumno[$fecha] = $estadoAsistencia;
            }

            $asistenciasData[$alumno->nombre] = $asistenciaAlumno;
        }

        return response()->json([
            'asignaturas' => $asignaturas,
            'alumnos' => $alumnos,
            'curso' => $curso,
            'fechasAsistencia' => $fechasAsistencia,
            'asistenciasData' => $asistenciasData,
            'fechasCabeceras' => $fechasCabeceras,
        ]);
    }

    public function mostrarTodasNotas($cursoId)
    {
        $curso = Curso::find($cursoId);
        $alumnos = $curso->alumnos;
        $asignaturas = Asignatura::all();

        $evaluaciones = Evaluacion::where('cursos_id', $cursoId)->get();

        // Crear un array para almacenar las calificaciones por alumno y evaluación
        $calificacionesData = [];

        foreach ($alumnos as $alumno) {
            $calificacionesAlumno = [];

            foreach ($evaluaciones as $evaluacion) {
                // Obtener la calificación para esta evaluación y este alumno
                $calificacion = Calificacion::where('alumnos_id', $alumno->id)
                    ->where('evaluacion_id', $evaluacion->id)
                    ->first();

                // Obtener el valor de la calificación o indicar "Sin calificación"
                $valorCalificacion = $calificacion ? $calificacion->nota : 'Sin calificación';

                $calificacionesAlumno[$evaluacion->fecha_evaluacion] = $valorCalificacion;
            }

            $calificacionesData[$alumno->id] = $calificacionesAlumno;
        }

        // Obtener fechas y temas de las evaluaciones
        $fechasCabeceras = $evaluaciones->map(function ($evaluacion) {
            // Formatear la fecha y el tema como "dd/mm/yyyy - Tema"
            return Carbon::parse($evaluacion->fecha_evaluacion)->format('d/m/Y') . ' - ' . $evaluacion->observaciones;
        });

        return response()->json([
            'asignaturas' => $asignaturas,
            'alumnos' => $alumnos,
            'curso' => $curso,
            'evaluaciones' => $evaluaciones,
            'calificacionesData' => $calificacionesData,
            'fechasCabeceras' => $fechasCabeceras,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
