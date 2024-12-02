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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id('id_proyecto');
            $table->string('nombre_proyecto')->unique();
            $table->string('descripcion');
            $table->foreignId('esatdo_id')->constrained('estados')->onDelete('cascade');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('imagen')->nullable(); 
            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
