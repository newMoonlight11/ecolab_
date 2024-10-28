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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reactivo_id');
            $table->unsignedBigInteger('unidad_id');
            $table->unsignedBigInteger('laboratorio_id');
            $table->integer('cantidad');
            $table->date('fecha');
            $table->string('email');
            $table->timestamps();
        
            $table->foreign('reactivo_id')->references('id')->on('reactivos');
            $table->foreign('unidad_id')->references('id')->on('unidad');
            $table->foreign('laboratorio_id')->references('id')->on('laboratorio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
