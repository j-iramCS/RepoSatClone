<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Controllers
use App\Http\Controllers\CrearController;
use App\Http\Controllers\Admin\AdminPanelContoller;
use App\Http\Controllers\Admin\AdminTablasController;
use App\Http\Controllers\TramitesServicios\Ejercicios\Declaraciones\Normal\EjercicioAController;
use App\Http\Controllers\MisEjerciciosController;

Route::middleware(['auth'])->group(function () {

    // Ruta de Creación
    Route::get('/crear', [CrearController::class, 'index'])->name('index.create');
    Route::prefix('/crear/ejercicio/declaracion')->group(function () {
        // Declaracion A
        Route::get('/provisional-normal-impuesto-valor-agregado-personas-fisicas', [EjercicioAController::class, 'index'])->name('index.declaracion.a');
        Route::post('/provisional-normal-impuesto-valor-agregado-personas-fisicas', [EjercicioAController::class, 'store'])->name('store.declaracion.a');
    });

    // Ruta de Mis Ejercicios
    Route::get('/mis-ejercicios', [MisEjerciciosController::class, 'index'])->name('index.user.ejercicios');
    Route::prefix('/mis-ejercicios')->group(function () {
        Route::post('/', [MisEjerciciosController::class, 'getData'])->name('get.data.user.ejercicios');
    });


    // Rutas Admin
    Route::get('/panel-admin', [AdminPanelContoller::class, 'index'])->name('panel.admin');

});
