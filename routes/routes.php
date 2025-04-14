<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ControllerMain;


Route::get('/crear', [ControllerMain::class, 'index'])->name('general.create');
Route::get('/crear/1/1/9/1', [ControllerMain::class, 'ejercicioA'])->name('crear.ejercicio.a');
