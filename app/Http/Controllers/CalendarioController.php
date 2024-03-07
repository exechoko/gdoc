<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Curso;
use App\Models\Evaluacion;
use App\Models\Horario;
use Carbon\Carbon;
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
        //dd($cursos);
        $tipo_evento = $request->tipo_evento;
        $nuevosEventos = [];
        $eventos = [];

        switch ($tipo_evento) {
            case 'Horarios':
                $horarios = Horario::with('curso')
                    ->whereIn('curso_id', $cursos->pluck('id'))
                    ->get();
                foreach ($horarios as $horario) {
                    $eventos = $this->generateRecurringEvents($horario->dia_semana, $horario->ingreso, $horario->salida, $horario->curso);
                    $nuevosEventos = array_merge($nuevosEventos, $eventos);
                }
                break;
            case 'Cumpleaños':
                $alumnos = Alumno::with('curso')
                    ->whereIn('cursos_id', $cursos->pluck('id'))
                    ->get();
                //dd($alumnos);
                foreach ($alumnos as $alumno) {
                    // Obtén el día y mes del cumpleaños del alumno
                    if ($alumno->fecha_nacimiento) {
                        // Verifica si la fecha de nacimiento es una cadena y conviértela a un objeto Carbon si es necesario
                        $fecha_nacimiento = is_string($alumno->fecha_nacimiento) ? Carbon::parse($alumno->fecha_nacimiento) : $alumno->fecha_nacimiento;

                        $dia_cumpleanos = $fecha_nacimiento->day;
                        $mes_cumpleanos = $fecha_nacimiento->month;

                        // Agrega un evento para cada cumpleaños en la misma fecha
                        $nuevosEventos[] = [
                            'title' => 'Cumpleaños de ' . $alumno->apellido . ' ' . $alumno->nombre . ' Escuela: ' . $alumno->curso->escuela->nombre,
                            'start' => date('Y') . '-' . $mes_cumpleanos . '-' . $dia_cumpleanos, // Ajusta según el formato necesario
                            'end' => date('Y') . '-' . $mes_cumpleanos . '-' . $dia_cumpleanos,
                        ];
                    }
                }
                //dd($nuevosEventos);
                break;
            case 'Evaluaciones':
                $evaluaciones = Evaluacion::with(['curso', 'asignatura'])
                    ->whereIn('cursos_id', $cursos->pluck('id'))
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

    private function generateRecurringEvents($diaSemana, $horaInicio, $horaFin, $curso)
    {
        $eventos = [];
        $isoDay = $this->getIsoDay($diaSemana);
        if ($isoDay === null) {
            return $eventos;
        }
        // Configura las fechas de inicio y fin según el día de la semana y las horas proporcionadas
        $startDateTime = now()->next($isoDay)->setTimeFromTimeString($horaInicio);
        $endDateTime = now()->next($isoDay)->setTimeFromTimeString($horaFin);
        // Genera eventos para cada día de la semana en el rango de fechas proporcionado
        while ($startDateTime->lte(now()->addMonths(6))) {
            $eventos[] = [
                'title' => $curso->escuela->nombre . ' - ' . $curso->nivel . ' ' . $curso->division,
                'start' => $startDateTime->format('Y-m-d H:i:s'),
                'end' => $endDateTime->format('Y-m-d H:i:s'),
            ];
            $startDateTime->addWeek();
            $endDateTime->addWeek();
        }
        return $eventos;
    }

    private function getIsoDay($diaSemana)
    {
        $diasSemana = [
            'Lunes' => 1,
            'Martes' => 2,
            'Miércoles' => 3,
            'Jueves' => 4,
            'Viernes' => 5,
            'Sábado' => 6,
            'Domingo' => 7,
        ];
        return $diasSemana[$diaSemana] ?? null;
    }
}
