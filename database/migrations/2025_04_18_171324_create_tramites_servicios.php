<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tramites_servicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_tramite_servicio_id');
            $table->unsignedBigInteger('cat_tipo_tramite_id');
            $table->unsignedBigInteger('creador_id');
            $table->timestamps();
            // $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));



            $table->foreign('cat_tramite_servicio_id')
                ->references('id')->on('cat_tramites_servicios')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('cat_tipo_tramite_id')
                ->references('id')->on('cat_tipo_tramites')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('creador_id')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tramites_servicios');
    }
};
