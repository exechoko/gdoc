<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->foreignId('asignatura_id')->after('escuelas_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            // Eliminar la restricción de clave externa antes de eliminar la columna
            $table->dropForeign(['asignatura_id']);
            // Eliminar la columna
            $table->dropColumn('asignatura_id');
        });
    }
};
