<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horarios';
    protected $fillable = [
        'escuela_id',
        'curso_id',
        'user_id',
        'asignatura_id',
        'dia_semana',
        'ingreso',
        'salida',
        'observaciones'
    ];
    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }
}
