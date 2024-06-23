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

use Modules\Health\Http\Controllers\Odontology\HealOdoAppointmentController;

Route::middleware(['auth', 'verified'])->prefix('health')->group(function () {
    Route::get('dashboard', 'HealthController@index');
    Route::get('patients', 'HealPatientController@index')->name('heal_patients_list');
    Route::get('patients/create', 'HealPatientController@create')->name('heal_patients_create');
    Route::post('patients/store', 'HealPatientController@store')->name('heal_patients_store');
    Route::get('patients/edit/{id}', 'HealPatientController@edit')->name('heal_patients_edit');
    Route::post('patients/update', 'HealPatientController@update')->name('heal_patients_update');
    Route::delete('patients/destroy/{id}', 'HealPatientController@destroy')->name('heal_patients_destroy');
    Route::get('patients/panel/{id}', 'HealPatientController@patientPanel')->name('heal_patients_panel');

    Route::get('doctor', 'DoctorController@index')->name('heal_doctors_list');
    Route::get('doctor/create', 'DoctorController@create')->name('heal_doctors_create');
    Route::post('doctor/store', 'DoctorController@store')->name('heal_doctors_store');
    Route::get('doctor/edit/{id}', 'DoctorController@edit')->name('heal_doctors_edit');
    Route::post('doctor/update', 'DoctorController@update')->name('heal_doctors_update');
    Route::delete('doctor/destroy/{id}', 'DoctorController@destroy')->name('heal_doctors_destroy');
});
