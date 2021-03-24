<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/dispositivos', DeviceController::class);
    Route::resource('/clientes', CustomerController::class);

    Route::get('/mantenimientos', [MaintenanceController::class,'getIndex'])->name('mantenimientos.index');
    Route::get('/mantenimientos/create', [MaintenanceController::class,'getCreate'])->name('mantenimientos.create');
    Route::post('/mantenimientos/create', [MaintenanceController::class,'postStore'])->name('mantenimientos.store');
    Route::get('/mantenimientos/edit/{id}', [MaintenanceController::class,'getEdit'])->name('mantenimientos.edit');
    Route::put('/mantenimientos/update/{id}', [MaintenanceController::class, 'putUpdate'])->name('mantenimientos.update');
    Route::delete('/mantenimientos/delete/{id}', [MaintenanceController::class,'deleteDestroy'])->name('mantenimientos.destroy');

    Route::resource('/tecnicos', TechnicianController::class)->middleware('admin');

    Route::get('/perfil', [ProfileController::class,'index'])->name('profile.index');
    Route::get('/perfil/editar-datos', [ProfileController::class,'editPersonalData'])->name('profile.edit_personal_data')->middleware('password.confirm');
    Route::get('/perfil/editar-contrasena', [ProfileController::class,'editPassword'])->name('profile.edit_password')->middleware('password.confirm');
    Route::put('/perfil/actualizar-datos', [ProfileController::class, 'updatePersonalData'])->name('profile.update_personal_data');
    Route::put('/perfil/actualizar-contrasena', [ProfileController::class,'updatePassword'])->name('profile.update_password');
});
