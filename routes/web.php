<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/', function () {
    return redirect('sign-in');
})->middleware('guest');*/
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
    return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
    return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UserController::class);
    Route::resource('cursos', CursoController::class);
    Route::resource('alumnos', AlumnoController::class);
    Route::resource('asistencias', AsistenciaController::class);
    Route::resource('calificaciones', CalificacionController::class);
    Route::resource('asignaturas', AsignaturaController::class);
    Route::resource('escuelas', EscuelaController::class);

    Route::get('/obtener-notas/{alumnoId}', [CursoController::class, 'obtenerNotas'])->name('obtener-notas');
    Route::get('/obtener-calificaciones/{evaluacionId}', [CursoController::class, 'obtenerCalificaciones'])->name('obtener-calificaciones');
    Route::get('/obtener-asistencias/{alumnoId}', [CursoController::class, 'obtenerAsistencias'])->name('obtener-asistencias');
    Route::get('/nueva-asistencia/{cursoId}', [CursoController::class, 'nuevaAsistencia'])->name('cursos.nueva-asistencia');
    Route::get('/nueva-calificacion/{cursoId}', [CursoController::class, 'nuevaCalificacion'])->name('cursos.nueva-calificacion');
    Route::post('/guardar-asistencia/{cursoId}', [CursoController::class, 'guardarAsistencia'])->name('cursos.guardar-asistencia');
    Route::post('/calificar/{cursoId}', [CursoController::class, 'calificar'])->name('cursos.calificar');
    Route::post('/nueva-evaluacion/{cursoId}', [CursoController::class, 'nuevaEvaluacion'])->name('cursos.nueva-evaluacion');
    Route::get('/mostrar-asistencias/{cursoId}', [CursoController::class, 'mostrarAsistencias'])->name('cursos.mostrar-asistencias');
    Route::get('/mostrar-todas-notas/{cursoId}', [CursoController::class, 'mostrarTodasNotas'])->name('cursos.mostrar-todas-notas');

    Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.index');
    Route::post('/calendario/fetch-events', [CalendarioController::class, 'fetchEvents'])->name('calendario.fetchEvents');

    Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios.index');
    Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios.index');
    Route::post('/horarios/store', [HorarioController::class, 'store'])->name('horarios.store');



    Route::get('billing', function () {
        return view('pages.billing');
    })->name('billing');
    Route::get('tables', function () {
        return view('pages.tables');
    })->name('tables');
    Route::get('rtl', function () {
        return view('pages.rtl');
    })->name('rtl');
    Route::get('virtual-reality', function () {
        return view('pages.virtual-reality');
    })->name('virtual-reality');
    Route::get('notifications', function () {
        return view('pages.notifications');
    })->name('notifications');
    Route::get('static-sign-in', function () {
        return view('pages.static-sign-in');
    })->name('static-sign-in');
    Route::get('static-sign-up', function () {
        return view('pages.static-sign-up');
    })->name('static-sign-up');
    Route::get('user-management', function () {
        return view('pages.laravel-examples.user-management');
    })->name('user-management');
    Route::get('user-profile', function () {
        return view('pages.laravel-examples.user-profile');
    })->name('user-profile');
});
