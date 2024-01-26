<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $standard = Role::create(['name' => 'Docente']);

        $superAdmin->givePermissionTo([
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario'
        ]);

        $admin->givePermissionTo([
            'ver-rol',
            'crear-rol',
            'editar-rol',

            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario'
        ]);

        $standard->givePermissionTo([
            'ver-rol',
            'ver-usuario'
        ]);
    }
}
