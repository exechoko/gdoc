<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Escuela;
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
                // Verifica si el usuario tiene el rol de "docente"
                if ($user->hasRole('Docente')) {
                    // Obtén los cursos del usuario con relaciones cargadas
                    $cursos = $user->cursos()->with('escuela')->get();
                    //dd($cursos);
                }
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
