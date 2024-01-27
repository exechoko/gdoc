<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Escuela extends Model
{
    use HasFactory;
    protected $table = 'escuelas';
    protected $fillable = [
        'tipo_escuelas_id',
        'nombre',
        'direccion',
        'nro',
        'pais',
        'provincia',
        'ciudad',
        'cue',
        'telefono'
    ];

    public function tipoEscuela()
    {
        return $this->belongsTo(TipoEscuela::class, 'tipo_escuelas_id');
    }

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
