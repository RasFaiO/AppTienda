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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('venta_id');
            $table->unsignedInteger('articulo_id');
            $table->integer('cantidad');
            $table->decimal('precio_venta',11,2);
            $table->decimal('descuento',11,2);
            $table->timestamps();

            $table->foreignId('ventas_id')->references('id')->on('ventas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('articulos_id')->references('id')->on('articulos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
