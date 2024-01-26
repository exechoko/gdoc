<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    public function index()
    {
        $eventos = [];

        $tipos_evento = ['Evaluaciones', 'Horarios', 'Cumpleaños'];
        $evaluaciones = Evaluacion::with(['curso', 'asignatura'])->get();
        //dd($evaluaciones);

        /*foreach ($evaluaciones as $evaluacion) {
            $eventos[] = [
                'title' => 'Evaluación de '. $evaluacion->asignatura->nombre . ' Esc: ' . $evaluacion->curso->escuela->nombre . ' Curso: ' . $evaluacion->curso->nivel . ' ' . $evaluacion->curso->division,
                'start' => $evaluacion->fecha_evaluacion,
                'end' => $evaluacion->fecha_evaluacion,
            ];
        }*/

        return view('calendario.index', compact('tipos_evento', 'eventos'));

    }
    public function fetchEvents(Request $request)
    {
        //dd($request->tipo_evento);
        $user = Auth::user();
        dd($user->cursos);
        $tipo_evento = $request->tipo_evento;
        $nuevosEventos = [];

        switch ($tipo_evento) {
            case 'Cumpleaños':
                $alumnos = $user->cursos->alumnos->get();
                foreach ($alumnos as $alumno) {
                    $nuevosEventos[] = [
                        'title' => 'Cumpleaños de ' . $alumno->apellido . ' ' . $alumno->nombre . ' Escuela: ' . $alumno->escuela->nombre,
                        'start' => $alumno->fecha_nacimiento,
                        'end' => $alumno->fecha_nacimiento,
                    ];
                }
                break;
            case 'Evaluaciones':
                $evaluaciones = Evaluacion::with(['curso', 'asignatura'])
                    ->whereIn('cursos_id', $user->cursos->pluck('id'))
                    ->get();
                //dd($evaluaciones);
                foreach ($evaluaciones as $evaluacion) {
                    $nuevosEventos[] = [
                        'title' => 'Evaluación de ' . $evaluacion->asignatura->nombre . ' Esc: ' . $evaluacion->curso->escuela->nombre . ' Curso: ' . $evaluacion->curso->nivel . ' ' . $evaluacion->curso->division,
                        'start' => $evaluacion->fecha_evaluacion,
                        'end' => $evaluacion->fecha_evaluacion,
                    ];
                }
                break;
        }
        return response()->json(['events' => $nuevosEventos]);
    }
}
