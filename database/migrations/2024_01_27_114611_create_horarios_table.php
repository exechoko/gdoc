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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('escuela_id')->constrained();
            $table->foreignId('curso_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('asignatura_id')->nullable()->constrained();
            $table->string('dia_semana')->nullable();
            $table->time('ingreso')->nullable();
            $table->time('salida')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
