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
        Schema::create('stock_reactivos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_stock');
            $table->integer('cantidad_existencia');
            $table->timestamps();
            $table->unsignedBigInteger('reactivo_id');
            $table->foreign('reactivo_id')->references('id')->on('reactivos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_reactivos');
    }
};
