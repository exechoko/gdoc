<?php

namespace Database\Seeders;

use App\Models\Escuela;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EscuelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $escuelas = [
            [
                'tipo_escuelas_id' => 3, //1: Inicial, 2: Primaria, 3: Secundaria, 4: Terciaria, 5: Universitaria
                'nombre' => 'ESCUELA SECUNDARIA BRIGADIER GENERAL DON J M DE ROSAS 18',
                'nro' => '',
                'direccion' => 'BURMEISTER Y 1°DE MAYO PARANA XIII B°PARANÁ XIII',
                'pais' => 'ARGENTINA',
                'provincia' => 'ENTRE RÍOS',
                'ciudad' => 'PARANÁ',
                'cue' => '300166300',
                'telefono' => '4374130',
            ],
            [
                'tipo_escuelas_id' => 3, //1: Inicial, 2: Primaria, 3: Secundaria, 4: Terciaria, 5: Universitaria
                'nombre' => 'ESC. SECUNDARIA DE GESTION SOCIAL PABLO DE TARSO D-242',
                'nro' => 'D-242',
                'direccion' => 'LOS MINUANES 9101 Anacleto Medina Sur',
                'pais' => 'ARGENTINA',
                'provincia' => 'ENTRE RÍOS',
                'ciudad' => 'PARANÁ',
                'cue' => '300331600',
                'telefono' => '4312791',
            ],
            [
                'tipo_escuelas_id' => 3, //1: Inicial, 2: Primaria, 3: Secundaria, 4: Terciaria, 5: Universitaria
                'nombre' => 'ESCUELA SECUNDARIA MONSEÑOR ABEL BAZAN Y BUSTOS 3',
                'nro' => '',
                'direccion' => 'SANTOS VEGA 1160 EL SOL II',
                'pais' => 'ARGENTINA',
                'provincia' => 'ENTRE RÍOS',
                'ciudad' => 'PARANÁ',
                'cue' => '300187200',
                'telefono' => '',
            ],
            [
                'tipo_escuelas_id' => 3, //1: Inicial, 2: Primaria, 3: Secundaria, 4: Terciaria, 5: Universitaria
                'nombre' => 'ESCUELA SECUNDARIA NUESTRA SRA DE GUADALUPE 28',
                'nro' => '',
                'direccion' => 'RCA. DE SIRIA 2700 LA FLORESTA',
                'pais' => 'ARGENTINA',
                'provincia' => 'ENTRE RÍOS',
                'ciudad' => 'PARANÁ',
                'cue' => '300166900',
                'telefono' => '4375570 / 4301640',
            ],

        ];
        //Verificar si la clave ya existe, sino agregarla a la tabla config_celular_empresa
        foreach ($escuelas as $escuela) {
            $existencia = Escuela::where('tipo_escuelas_id', $escuela['tipo_escuelas_id'])
            ->where('nombre', $escuela['nombre'])->exists();
            if (!$existencia) {
                Escuela::create($escuela);
            }
        }
    }
}
