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
        // los otros metodos son table = Actualiza una tabla, dropifexist = elimina la tabla si existe
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('descripcion',255)->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
