<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function tipoEscuela(){
        return $this->belongsTo(TipoEscuela::class);
    }

    public function curso(){
        return $this->hasMany(Curso::class);
    }
    public function alumno(){
        return $this->hasMany(Alumno::class);
    }
}
