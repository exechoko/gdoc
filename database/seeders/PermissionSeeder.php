<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

            'ver-tipo-escuela',
            'crear-tipo-escuela',
            'editar-tipo-escuela',
            'borrar-tipo-escuela',

            'ver-escuela',
            'crear-escuela',
            'editar-escuela',
            'borrar-escuela',

            'ver-curso',
            'crear-curso',
            'editar-curso',
            'borrar-curso',

            'ver-alumno',
            'crear-alumno',
            'editar-alumno',
            'borrar-alumno'
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            // Verificar si el permiso ya existe antes de crearlo
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
