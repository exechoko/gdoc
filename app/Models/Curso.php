<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $table = 'cursos';
    protected $fillable = [
        'escuelas_id',
        'nivel',
        'division',
        'observaciones'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function escuela(){
        return $this->belongsTo(Escuela::class);
    }

    public function alumno(){
        return $this->hasMany(Alumno::class);
    }
    public function asistencia(){
        return $this->hasMany(Asistencia::class);
    }
}
