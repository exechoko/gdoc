<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'alumnos';
    protected $fillable = [
        'cursos_id',
        'escuelas_id',
        'nombre',
        'apellido',
        'dni',
        'email',
        'direccion',
        'ciudad',
        'provincia',
        'pais',
        'telefono',
        'observaciones'
    ];

    public function escuela(){
        return $this->belongsTo(Escuela::class);
    }

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function calificacion(){
        return $this->hasMany(Calificacion::class);
    }
}
