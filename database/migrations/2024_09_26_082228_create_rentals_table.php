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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('bicycle_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('second_end_time')->nullable();
            $table->integer('price')->nullable();
            $table->enum('state',['Arquilada','Devuelta']);
            $table->decimal('start_latitude', 9, 6)->nullable();
            $table->decimal('start_longitude', 9, 6)->nullable();
            $table->decimal('end_latitude', 9, 6)->nullable();
            $table->decimal('end_longitude', 9, 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
