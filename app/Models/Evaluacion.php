<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    protected $table = 'evaluaciones';
    protected $fillable = [
        'asignatura_id',
        'cursos_id',
        'fecha_evaluacion',
        'observaciones'
    ];

    public function curso(){
        return $this->belongsTo(Curso::class, 'cursos_id');
    }
    public function asignatura(){
        return $this->belongsTo(Asignatura::class, 'asignatura_id');
    }

    public function calificacion(){
        return $this->hasMany(Calificacion::class);
    }
}
