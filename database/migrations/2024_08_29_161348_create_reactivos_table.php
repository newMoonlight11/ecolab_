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
        Schema::create('reactivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del reactivo
            //$table->date('fecha_vencimiento'); // Fecha de vencimiento del reactivo
            //$table->integer('cantidad'); // Cantidad en stock
            //$table->string('laboratorio'); // Laboratorio en el que se encuentra
            //$table->string('familia'); // Familia a la que pertenece
            $table->string('img_reactivo')->nullable();
            $table->string('numero_cas');
            $table->string('referencia_fabricante');
            $table->string('lote');
            $table->string('num_registro_invima');

            $table->timestamps();

            $table->unsignedBigInteger('familia_id');
            $table->foreign('familia_id')->references('id')->on('familias');

            //MARCA
            $table->unsignedBigInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactivos');
    }
};
