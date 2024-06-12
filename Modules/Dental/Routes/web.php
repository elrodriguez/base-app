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

use Modules\Dental\Http\Controllers\AppointmentController;

Route::middleware(['auth', 'verified'])->prefix('dental')->group(function () {
    Route::get('/', 'DentalController@index')->name('dental_dashboard');

    ///////odontologico/////////

    Route::get('appointments', [AppointmentController::class, 'index'])->name('odontology_appointments_list');
    Route::post('appointments/store', [AppointmentController::class, 'store'])->name('odontology_appointments_store');
    Route::put('appointments/update/{id}', [AppointmentController::class, 'update'])->name('odontology_appointments_update');
    Route::put('appointments/update_status/{id}', [AppointmentController::class, 'updateStatus'])->name('odontology_appointments_update_status');
    Route::put('appointments/update_important/{id}', [AppointmentController::class, 'updateImportant'])->name('odontology_appointments_update_important');
    Route::delete('appointments/destroy/{id}', [AppointmentController::class, 'destroy'])->name('odontology_appointments_destroy');
    Route::get('event/appointments', [AppointmentController::class, 'getDentAppointments'])->name('dental_event_appointments');
});
