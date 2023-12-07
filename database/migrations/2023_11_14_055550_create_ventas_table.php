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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tipo_comprobante',20);
            $table->string('serie_comprobante',10);
            $table->string('num_comprobante',13);
            $table->decimal('impuesto',9,2);
            $table->decimal('total_venta',12,2);
            $table->string('estado',20);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
