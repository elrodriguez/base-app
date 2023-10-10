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

Route::middleware(['auth', 'verified'])->prefix('health')->group(function () {
    Route::get('dashboard', 'HealthController@index');
    Route::get('Patients', 'HealPatientController@index')->name('heal_patients_list');
    Route::get('Patients/create', 'HealPatientController@create')->name('heal_patients_create');
});
