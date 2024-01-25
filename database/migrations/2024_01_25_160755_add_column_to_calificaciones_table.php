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
        Schema::table('calificaciones', function (Blueprint $table) {
            $table->foreignId('evaluacion_id')->after('id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calificaciones', function (Blueprint $table) {
            // Eliminar la restricción de clave externa antes de eliminar la columna
            $table->dropForeign(['evaluacion_id']);
            // Eliminar la columna
            $table->dropColumn('evaluacion_id');
        });
    }
};
