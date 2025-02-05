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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->date('fecha'); //  D-M-Y
            $table->time('hora_inicio')->nullable(); //  NULL si es un evento de todo el día
            $table->time('hora_fin')->nullable(); // NULL si no tiene duración
            $table->boolean('notificar')->default(true); // Notificación activada por defecto
            $table->integer('minutos_previos_notificacion')->default(30);
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
