<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $adminRole = Role::where('name', 'Admin')->first();
        $standardRole = Role::where('name', 'Standard')->first();

        if (!$superAdminRole) {
            $superAdminRole = Role::create(['name' => 'Super Admin']);
        }
        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'Admin']);
        }
        if (!$standardRole) {
            $standardRole = Role::create(['name' => 'Standard']);
        }

        $superAdminUser = User::where('email', 'superadmin@gdoc.com')->first();
        $adminUser = User::where('email', 'admin@gdoc.com')->first();
        $standardUser = User::where('email', 'standard@gdoc.com')->first();

        if (!$superAdminUser) {
            $superAdminUser = User::factory()->create([
                'name' => 'Super Admin',
                'email' => 'superadmin@gdoc.com',
                'password' => 123456
            ]);
        }
        if (!$adminUser) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@gdoc.com',
                'password' => Hash::make('123456')
            ]);
        }
        if (!$standardUser) {
            $standardUser = User::create([
                'name' => 'Standard',
                'email' => 'standard@gdoc.com',
                'password' => Hash::make('123456')
            ]);
        }

        $superAdminUser->assignRole($superAdminRole);
        $admin->assignRole($adminRole);
        $standardUser->assignRole($standardRole);
    }
}
