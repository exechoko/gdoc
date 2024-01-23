<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;
    protected $table = 'asignaturas';
    protected $fillable = [
        'nombre',
        'observaciones'
    ];

    public function calificaciones(){
        return $this->hasMany(Calificacion::class);
    }
}
