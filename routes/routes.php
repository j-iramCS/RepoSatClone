<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Controllers
use App\Http\Controllers\CrearEjercicioController;
use App\Http\Controllers\CrearActividadContoller;

use App\Http\Controllers\Admin\AdminPanelContoller;
use App\Http\Controllers\TramitesServicios\Ejercicios\Declaraciones\Normal\EjercicioAController;
use App\Http\Controllers\TramitesServicios\Actividades\Declaraciones\Normal\ActividadAController;
use App\Http\Controllers\usersEjerciciosController;

Route::middleware(['auth'])->group(function () {

    // Ruta de Creación
    Route::get('/crear/ejercicio', [CrearEjercicioController::class, 'index'])->name('index.crear.ejercicio');
    Route::prefix('/crear/ejercicio/declaracion')->group(function () {
        // Ejercicio Obligacion A
        Route::get('/provisional-normal-impuesto-valor-agregado-personas-fisicas', [EjercicioAController::class, 'index'])->name('index.ejercicio.obligacion.a');
        Route::post('/provisional-normal-impuesto-valor-agregado-personas-fisicas', [EjercicioAController::class, 'store'])->name('store.ejercicio.obligacion.a');
    });

    Route::get('/crear/actividad', [CrearActividadContoller::class, 'index'])->name('index.crear.actividad');
    Route::prefix('/crear/actividad/declaracion')->group(function () {
        // Actividad Declaracion A
        Route::get('/provisional-normal-impuesto-valor-agregado-personas-fisicas', [ActividadAController::class, 'index'])->name('index.actividad.declaracion.a');
        Route::post('/provisional-normal-impuesto-valor-agregado-personas-fisicas', [ActividadAController::class, 'store'])->name('store.actividad.declaracion.a');
    });


    // Ruta de Mis Ejercicios
    Route::get('/mis-ejercicios', [usersEjerciciosController::class, 'index'])->name('index.user.ejercicios');
    Route::prefix('/mis-ejercicios')->group(function () {
        Route::post('/', [usersEjerciciosController::class, 'getData'])->name('get.data.user.ejercicios');
    });


    // Rutas Admin
    Route::prefix('/panel-admin')->group(function () {
        Route::get('/', [AdminPanelContoller::class, 'index'])->name('panel.admin');
        Route::get('/usuarios', [AdminPanelContoller::class, 'vistaUsuarios'])->name('panel.admin.usuarios');
    });



    Route::get('/vistaA', function () {
        return Inertia::render('VistaA');
    })->name('vistaA');
});
