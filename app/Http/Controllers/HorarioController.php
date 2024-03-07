<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Escuela;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-horario|crear-horario|editar-horario|borrar-horario', ['only' => ['index']]);
        $this->middleware('permission:crear-horario', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-horario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-horario', ['only' => ['destroy']]);
    }
    public function index()
    {
        $user = Auth::user();
        $cursos = null;
        $asignaturas = Asignatura::all();
        $escuelas = Escuela::all();
        // Verifica si el usuario tiene el rol de "super-admin" o "admin"
        if ($user->hasRole(['Super Admin', 'Admin'])) {
            $cursos = Curso::all();
            $horarios = Horario::with('escuela', 'curso', 'asignatura')->get();
            //dd($alumnos);
        } else {
            if ($user->hasRole('Docente') || $user->hasRole('Docente Premium') || $user->hasRole('Docente Pro')) {
                $cursos = $user->cursos()->get();
                $idsCursos = $cursos->pluck('id');
                $horarios = Horario::with('escuela', 'curso', 'asignatura')->whereIn('curso_id', $idsCursos)->get();
            }
        }
        return view('horarios.index', compact('horarios', 'cursos', 'asignaturas', 'escuelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'escuela' => 'required',
                'asignatura' => 'required',
                'curso' => 'required',
                'ingreso' => 'required',
                'salida' => 'required',
                'dias' => 'required', // Asegúrate de agregar validación para los días
            ], [
                'required' => 'El campo :attribute es necesario completar.'
            ]);

            //dd('aca');
            DB::beginTransaction();

            $dias = explode(', ', $request->input('dias'));
            //dd($dias);

            foreach ($dias as $dia) {
                Horario::create([
                    'user_id' => auth()->id(),
                    'escuela_id' => $request->input('escuela'),
                    'asignatura_id' => $request->input('asignatura'),
                    'curso_id' => $request->input('curso'),
                    'ingreso' => $request->input('ingreso'),
                    'salida' => $request->input('salida'),
                    'observaciones' => $request->input('observaciones'),
                    'dia_semana' => $dia, // Asegúrate de tener un campo 'dia_semana' en tu tabla
                ]);
            }

            DB::commit();
            return redirect()->route('horarios.index')->with('success', 'Horarios creados exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear los horarios: ' . $e->getMessage());
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
