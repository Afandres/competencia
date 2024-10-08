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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('document_number')->unique();
            $table->enum('document_type',['Cédula de ciudadanía','Tarjeta de identidad','Cédula de extranjería']);
            $table->bigInteger('telephone');
            $table->string('email');
            $table->enum('stratum',['1','2','3','4','5','6']);
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
