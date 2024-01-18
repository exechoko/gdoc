<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoEscuelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos a insertar
        $tiposEscuelas = ["Inicial", "Primaria", "Secundaria", "Terciaria", "Universitaria"];

        // Iterar sobre los datos y realizar la inserción
        foreach ($tiposEscuelas as $tipo) {
            DB::table('tipo_escuelas')->insert([
                'nombre' => $tipo,
            ]);
        }
    }
}
