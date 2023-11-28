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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('categorias_id')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
            // De esta manera declaramos la llave foranea, teniendo en cuenta la relación que colocamos dentro del modelo, en este caso, muchos artículos tienen una categoria 
            $table->foreignId('categorias_id')->constrained()->cascadeOnDelete();
            $table->string('codigo',50)->nullable();
            $table->string('nombre',100);
            $table->integer('stock');
            $table->string('descripcion')->max(400)->nullable();
            $table->string('image_uri',50)->nullable();
            $table->string('estado',20)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
