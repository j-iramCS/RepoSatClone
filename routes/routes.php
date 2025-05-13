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
        Route::get('/urp', [AdminPanelContoller::class, 'vistaURP'])->name('panel.admin.urp');

        Route::get('/urp/rol/{id}', [AdminPanelContoller::class, 'vistaRol'])->name('panel.admin.rol');
        Route::post('/urp/rol/{id}/guardar-permisos', [AdminPanelContoller::class, 'guardarPermisosDelRol'])->name('panel.admin.rol.guardarPermisos');
        Route::post('/urp/guardar-roles-masivos', [AdminPanelContoller::class, 'guardarRolesMasivos'])->name('panel.admin.guardar.rolesMasivos');
        Route::post('/urp/guardar-roles', [AdminPanelContoller::class, 'guardarRoles'])->name('panel.admin.guardar.roles');
        Route::post('/urp/eliminar/rol/{rolId}/{userId}', [AdminPanelContoller::class, 'eliminarRol'])->name('panel.admin.eliminar.rol');

        Route::get('/urp/usuario/{id}', [AdminPanelContoller::class, 'vistaUsuario'])->name('panel.admin.usuario');

        Route::post('/urp/guardar-permisos', [AdminPanelContoller::class, 'guardarPermisos'])->name('panel.admin.guardar.permisos');



    });



    Route::get('/vistaA', function () {
        return Inertia::render('VistaA');
    })->name('vistaA');
});
