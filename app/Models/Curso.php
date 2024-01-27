<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;
    protected $table = 'cursos';
    protected $fillable = [
        'user_id',
        'escuelas_id',
        'asignatura_id',
        'nivel',
        'division',
        'observaciones'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'escuelas_id');
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'cursos_id');
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'cursos_id');
    }
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
