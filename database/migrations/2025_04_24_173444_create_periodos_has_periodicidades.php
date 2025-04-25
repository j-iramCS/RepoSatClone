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
        Schema::create('periodos_has_periodicidades', function (Blueprint $table) {
            $table->unsignedBigInteger('cat_periodo_id');
            $table->unsignedBigInteger('cat_periodicidad_id');
            $table->timestamps();

            $table->primary(['cat_periodo_id', 'cat_periodicidad_id']);

            $table->foreign('cat_periodo_id')
                ->references('id')
                ->on('cat_periodos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('cat_periodicidad_id')
                ->references('id')
                ->on('cat_periodicidades')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodos_has_periodicidades');
    }
};
