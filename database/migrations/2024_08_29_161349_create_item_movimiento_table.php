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
        Schema::create('item_movimiento', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('cantidad');


            $table->unsignedBigInteger('reactivo_id');
            $table->foreign('reactivo_id')->references('id')->on('reactivos');

            $table->unsignedBigInteger('movimiento_id');
            $table->foreign('movimiento_id')->references('id')->on('movimientos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_movimiento');
    }
};
