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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/dispositivos', 'DeviceController');
Route::resource('/clientes', 'CustomerController');

Route::get('/mantenimientos', 'MaintenanceController@getIndex')->name('mantenimientos.index');
Route::get('/mantenimientos/create', 'MaintenanceController@getCreate')->name('mantenimientos.create');
Route::post('/mantenimientos/create', 'MaintenanceController@postStore')->name('mantenimientos.store');
Route::get('/mantenimientos/edit/{id}', 'MaintenanceController@getEdit')->name('mantenimientos.edit');
Route::put('/mantenimientos/update/{id}', 'MaintenanceController@putUpdate')->name('mantenimientos.update');
Route::delete('/mantenimientos/delete/{id}', 'MaintenanceController@deleteDestroy')->name('mantenimientos.destroy');
