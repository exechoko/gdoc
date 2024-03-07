<?php

namespace App\Policies;

use App\Models\User;

class CursoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        if ($user->hasRole('Docente')) {
            return $user->cursos->count() < 1;
        } elseif ($user->hasRole('Docente Premium')) {
            return $user->cursos->count() < 2;
        } elseif ($user->hasRole('Docente Pro')) {
            return $user->cursos->count() < 5;
        }

        return false;
    }
}
