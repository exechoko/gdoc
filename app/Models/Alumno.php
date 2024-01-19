<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'fecha_nacimiento',
        'email',
        'direccion',
        'ciudad',
        'provincia',
        'pais',
        'telefono',
        'observaciones'
    ];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'escuelas_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'cursos_id');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}
