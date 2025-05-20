<?php

// 
use Illuminate\Support\Facades\Route;

// Controllers

use App\Http\Controllers\TramitesServicios\Actividades\Declaraciones\Anuales\DeclaracionAnualController;

use App\Http\Middleware\CheckCanLogin;

Route::middleware(['auth', CheckCanLogin::class])->group(function () {

    // Declacracion Anual
    Route::prefix('/crear/actividad/declaracion')->group(function () {
        Route::get('/anual', [DeclaracionAnualController::class, 'index'])->name('index.declaracion.anual');
    });

    

});
