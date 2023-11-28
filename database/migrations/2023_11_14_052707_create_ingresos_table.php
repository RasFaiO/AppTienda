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
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_provedor');
            $table->string('tipo_comprobante',20);
            $table->string('serie_comprobante',7)->nullable();
            $table->string('num_comprobante',10);
            $table->decimal('impuesto',9,2);
            $table->string('estado',20);
            $table->timestamps();

            $table->foreignId('personas_id')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
