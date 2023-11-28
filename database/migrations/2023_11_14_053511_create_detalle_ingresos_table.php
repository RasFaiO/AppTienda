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
        Schema::create('detalle_ingresos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_ingreso');
            $table->unsignedInteger('id_articulo');
            $table->integer('Cantidad');
            $table->decimal('precio_compra',11,2);
            $table->decimal('precio_venta',11,2)->nullable();
            $table->timestamps();

            $table->foreignId('ingresos_id')->references('id')->on('ingresos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('articulos_id')->references('id')->on('articulos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ingresos');
    }
};
