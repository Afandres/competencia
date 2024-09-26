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
        Schema::create('events', function (Blueprint $table) { // Paréntesis cerrado aquí
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('start_latitude', 9, 6)->nullable();
            $table->decimal('start_longitude', 9, 6)->nullable();
            $table->decimal('end_latitude', 9, 6)->nullable();
            $table->decimal('end_longitude', 9, 6)->nullable();
            $table->string('image')->nullable(); // Campo para almacenar la imagen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events'); // Cambiado para eliminar la tabla completa
    }
};
