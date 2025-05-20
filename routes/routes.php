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
use App\Http\Controllers\usersEjerciciosController;
use App\Http\Middleware\CheckCanLogin;

Route::middleware(['auth', CheckCanLogin::class])->group(function () {

    // Ruta de Creación
    Route::get('/crear/ejercicio', [CrearEjercicioController::class, 'index'])->name('index.crear.ejercicio');
    Route::prefix('/crear/ejercicio/declaracion')->group(function () {
        // Ejercicio Obligacion A
        Route::get('/provisional', [EjercicioAController::class, 'index'])->name('index.ejercicio.obligacion.a');
        Route::post('/provisional', [EjercicioAController::class, 'store'])->name('store.ejercicio.obligacion.a');
    });

    Route::get('/crear/actividad', [CrearActividadContoller::class, 'index'])->name('index.crear.actividad');
    Route::prefix('/crear/actividad/declaracion')->group(function () {
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
        Route::post('/urp/eliminar/rol/{rolId}/{userId}', [AdminPanelContoller::class, 'eliminarRoldelUsuario'])->name('panel.admin.eliminar.rol.usuario');
        Route::post('/urp/crear-rol', [AdminPanelContoller::class, 'crearRol'])->name('panel.admin.crear.rol');
        Route::post('/urp/eliminar-rol', [AdminPanelContoller::class, 'eliminarRol'])->name('panel.admin.eliminar.rol');

        Route::get('/urp/usuario/{id}', [AdminPanelContoller::class, 'vistaUsuario'])->name('panel.admin.usuario');

        Route::get('/urp/permiso/{id}', [AdminPanelContoller::class, 'vistaPermiso'])->name('panel.admin.permiso');
        Route::post('/urp/guardar-permisos', [AdminPanelContoller::class, 'guardarPermisos'])->name('panel.admin.guardar.permisos');
        Route::post('/urp/permiso/{id}/guardar-rol', [AdminPanelContoller::class, 'guardarRolesDelPermiso'])->name('panel.admin.permiso.guardarRol');
        Route::post('/urp/crear-permiso', [AdminPanelContoller::class, 'crearPermiso'])->name('panel.admin.crear.permiso');
        Route::post('/urp/eliminar-permiso', [AdminPanelContoller::class, 'eliminarPermiso'])->name('panel.admin.permiso.eliminar');
        Route::post('/urp/eliminar/permiso-del-usuario', [AdminPanelContoller::class, 'eliminarPermisodelUsuario'])->name('panel.admin.eliminar.permiso.usuario');


        Route::post('/urp/permitir-acceso', [AdminPanelContoller::class, 'permitirAcceso'])->name('panel.admin.permitir.acceso');


        // apis
        Route::post('/api/urp', [AdminPanelContoller::class, 'apiURP'])->name('panel.admin.api.urp');

    });



    Route::get('/vistaA', function () {
        return Inertia::render('VistaA');
    })->name('vistaA');
});
