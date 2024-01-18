<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;
    protected $table = 'calificaciones';
    protected $fillable = [
        'cursos_id',
        'alumnos_id',
        'nota',
        'observaciones'
    ];

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function alumno(){
        return $this->belongsTo(Alumno::class);
    }
}
