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
        Schema::create('residuo_laboratorios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_stock');
            $table->integer('cantidad_existencia');
            $table->unsignedBigInteger('residuo_id');
            $table->foreign('residuo_id')->references('id')->on('residuos');
            $table->unsignedBigInteger('laboratorio_id');
            $table->foreign('laboratorio_id')->references('id')->on('laboratorio');
            $table->unsignedBigInteger('unidad_id');
            $table->foreign('unidad_id')->references('id')->on('unidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residuo_laboratorios');
    }
};
