<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEscuela extends Model
{
    use HasFactory;
    protected $table = 'tipo_escuelas';
    protected $fillable = ['nombre', 'observaciones'];

    public function escuela(){
        return $this->hasMany(Escuela::class);
    }
}
