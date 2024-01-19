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
        'users_id',
        'escuelas_id',
        'nivel',
        'division',
        'observaciones'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'escuelas_id');
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
