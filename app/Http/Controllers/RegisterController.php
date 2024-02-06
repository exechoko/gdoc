<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:10',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:255',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de :max caracteres.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.max' => 'El teléfono debe ser válido.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no puede tener más de :max caracteres.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.max' => 'La contraseña no puede tener más de :max caracteres.',
        ]);
        //dd($attributes);

        $user = User::create($attributes);
        $user->assignRole('Docente');
        auth()->login($user);
        return redirect('/dashboard');
    }
}
