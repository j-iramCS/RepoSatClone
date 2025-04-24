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
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creador_id');
            $table->unsignedBigInteger('tipo_ejercicio_id');
            $table->json('datos');
            $table->timestamps();

            $table->foreign('creador_id')
            ->references('id')
            ->on('users')
            ->onDelete('no action')
            ->onUpdate('no action');

            $table->foreign('tipo_ejercicio_id')
            ->references('id')
            ->on('tipos_ejercicios')
            ->onDelete('no action')
            ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicios');
    }
};
