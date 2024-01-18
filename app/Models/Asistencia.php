<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencias';
    protected $fillable = [
        'cursos_id',
        'alumnos_id',
        'fecha_asistencia',
        'observaciones'
    ];

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function alumno(){
        return $this->hasMany(Alumno::class);
    }
}
